<?php

namespace App\Http\Controllers\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\HoaDon;
use App\Models\LoaiKhachHang;
class PaymentController extends Controller
{
   public function vnpay_payment(Request $request){
    $data = $request->all();
    session(['cost_id' => $request->id]);
    session(['url_prev' => url()->previous()]);
    session(['idHopDong' => $data['idHopDong'] ?? '']);
    session(['LoaiThanhToan' => $data['LoaiThanhToan'] ?? '']);
    session(['SoTienThanhToan' => $data['total'] ?? 0]);

    $vnp_TmnCode = "F0CGF7G9"; //Mã website tại VNPAY 
    $vnp_HashSecret = "NKIRX6874SPU7XP5BVMB9LP0JTFYCHKH"; //Chuỗi bí mật
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay";
    $vnp_TxnRef = rand(1,10000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán hóa đơn";
    $vnp_OrderType = 'billpayment';
    // $vnp_Amount = $request->input('amount') * 100;
     $vnp_Amount = $data['total'] * 100;

    $vnp_Locale = 'VN';
    $vnp_IpAddr = request()->ip();
    $vnp_BankCode="NCB";
    $inputData = array(
        "vnp_Version" => "2.0.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );
    if (!empty($vnp_BankCode)) {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = http_build_query($inputData, '', '&', PHP_QUERY_RFC3986);
    $hashdata = urldecode($query); // BẮT BUỘC DÙNG `urldecode`

    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $vnp_SecureHash;

    return redirect($vnp_Url);
   }
   public function vnpayReturn(Request $request)
{
    if ($request->vnp_ResponseCode == '00') {
        $idHopDong = session('idHopDong');
        $loaiThanhToan = session('LoaiThanhToan');
        $soTienThanhToan = session('SoTienThanhToan');

        // Tạo hóa đơn
        HoaDon::create([
            'idHopDong' => $idHopDong,
            'LoaiThanhToan' => $loaiThanhToan,
            'PhuongThuc' => $request->vnp_BankCode,
            'MaGiaoDich' => $request->vnp_TransactionNo,
            'NgayLap' => now(),
            'SoTienThanhToan' => $soTienThanhToan,
        ]);

        $hopdong = \App\Models\HopDong::find($idHopDong);
        $donhang = null;

        if ($hopdong) {
            if ($loaiThanhToan === 'Đặt cọc') {
                $hopdong->TongSoTienConLai = $hopdong->GiaTriGocHopDong - $hopdong->TienCoc;
                $hopdong->TienCoc = 0;
                $hopdong->TrangThaiCoc = 'Đã thanh toán đặt cọc';
                $hopdong->save();

                $donhang = DonHang::create([
                    'idHopDong' => $hopdong->id,
                    'NgayLap' => now(),
                    'TrangThai' => 'Chưa hoàn tất thanh toán',
                    'TongTienThanhToan' => $hopdong->TongSoTienConLai,
                ]);
            }

            if ($loaiThanhToan === 'Thanh toán toàn bộ') {
                $hopdong->TongSoTienConLai = 0;
                $hopdong->TienCoc = 0;
                $hopdong->TrangThaiCoc = 'Đã thanh toán đặt cọc';
                $hopdong->save();

                $donhang = DonHang::where('idHopDong', $hopdong->id)->first();
                if ($donhang) {
                    $donhang->TrangThai = 'Đã thanh toán toàn bộ';
                    $donhang->TongTienThanhToan = $hopdong->GiaTriGocHopDong;
                    $donhang->save();
                }
                else {
                    $donhang = DonHang::create([
                        'idHopDong' => $hopdong->id,
                        'NgayLap' => now(),
                        'TrangThai' => 'Đã thanh toán toàn bộ',
                        'TongTienThanhToan' => $hopdong->GiaTriGocHopDong,
                    ]);
                }
                // Cập nhật loại khách hàng
                $email = Auth::check() ? Auth::user()->khachHang->email : null;

                if ($email) {
                    // Đếm số đơn hàng đã thanh toán toàn bộ của khách hàng có email khớp
                    $soDonDaMua = \App\Models\DonHang::whereHas('hopDong.phieuDatHang', function ($query) use ($email) {
                        $query->where('Email', $email);
                    })->where('TrangThai', 'Đã thanh toán toàn bộ')->count();
                
                    $loaiKhach = LoaiKhachHang::where('DieuKien', '<=', $soDonDaMua)
                    ->orderByDesc('DieuKien')
                    ->first();
            
                    // Cập nhật loại khách hàng nếu tìm thấy
                    if ($loaiKhach) {
                        \App\Models\KhachHang::where('Email', $email)->update([
                            'idLoaiKhachHang' => $loaiKhach->id
                        ]);
                    }
                }
            }
        }

        return redirect()->route('thanhtoan.index')->with('success', 'Thanh toán thành công!');
    }

    return redirect()->route('thanhtoan.index')->with('error', 'Thanh toán bị huỷ hoặc thất bại.');
}

public function thongtinthanhtoan(){

}
}
