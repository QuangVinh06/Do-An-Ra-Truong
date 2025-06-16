<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\HopDong;
use App\Models\PhieuDatHang;
use App\Models\KhachHang;
use App\Models\ChiTietPhieuDatHang;
use App\Models\KhuyenMai;
use Carbon\Carbon;
class DonHangController extends Controller
{
    public function index(Request $request)

    {
        $query = $request->input('search'); 
        $dhs = DonHang::when($query, function ($q) use ($query) {
                $q->where('id', 'like', '%' . $query . '%');
        })->orderBy('id', 'desc')->paginate(5);
        return view('admin.donhang.index', compact('dhs'));
    }
    public function show(string $id)
    {
        $dh = DonHang::findOrFail($id);

        // Phiếu đặt hàng đang chờ xử lý
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->with('khuyenmai')->get();
        $ctdat = ChiTietPhieuDatHang::with('sanPham')->where('idPhieuDat', $id)->get();
    
        $tongTienGoc = $ctdat->sum('ThanhTien');
        $tongTienSauGiam = $PhieuDat->TongTien;
        $tienGiam = $tongTienGoc - $tongTienSauGiam;
    
        $TenKhuyenMai = $dat->khuyenmai?->TenKhuyenMai ?? 'Không có giảm giá';
        $GiamGia = $dat->khuyenmai?->GiamGia ?? 0;
    
        return view('admin.donhang.ctdonhang', compact('dh', 'PhieuDat', 'GiamGia'));
        
    }
    public function show2(string $id)
    {
        $dh = DonHang::findOrFail($id);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('client.ctdonhang2',compact('dh','PhieuDat'));
    }
    public function view() {
        $user = Auth::guard('web')->user(); // Lấy user đăng nhập
    
        if (!$user) {
            return redirect()->route('dangnhap')->with('error', 'Vui lòng đăng nhập để xem đơn hàng.');
        }
    
        // Tìm thông tin khách hàng gắn với tài khoản này
        $khachHang = \App\Models\KhachHang::where('idTaiKhoan', $user->id)->first();
    
        if (!$khachHang) {
            return redirect()->route('trangchu')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }
    
        // Lấy đơn hàng thông qua quan hệ: DonHang -> HopDong -> PhieuDatHang -> KhachHang
        $donHangs = \App\Models\DonHang::whereHas('hopDong.phieuDatHang', function ($query) use ($khachHang) {
            $query->where('Email', Auth::user()->email);
        })    ->whereDoesntHave('chiTietDoiTra') // << Lọc đơn hàng chưa đổi trả
        ->orderBy('NgayLap', 'desc')->get();
    
        return view('client.donhang', compact('donHangs'));
    }
    public function xacNhanThanhToan($id)
{
    $donHang = DonHang::find($id);

    // Kiểm tra điều kiện thanh toán
    if ($donHang->hopDong->TongSoTienConLai > 0 && $donHang->hopDong->phieuDatHang->phuongthuc->TenPhuongThucThanhToan == 'Thanh toán trực tiếp') {
        $donHang->hopDong->TongSoTienConLai = 0; // Cập nhật số tiền còn lại
        $donHang->TrangThai='Đã thanh toán toàn bộ';
        $donHang->hopDong->save();
        $donHang->save();
        $khachHang = $donHang->hopDong->phieuDatHang->khachHang;

        // Đếm số đơn hàng đã thanh toán của khách
        $soDonHangDaThanhToan = \App\Models\DonHang::whereHas('hopDong.phieuDatHang', function ($query) use ($khachHang) {
            $query->where('Email', Auth::user()->email);
        })->where('TrangThai', 'Đã thanh toán toàn bộ')->count();
        
        // Xác định ID loại khách hàng tương ứng
        if ($soDonHangDaThanhToan >= 10) {
            $loaiKhach = \App\Models\LoaiKhachHang::where('TenLoaiKhachHang', 'Khách hàng thân quen')->first();
        } elseif ($soDonHangDaThanhToan >= 3) {
            $loaiKhach = \App\Models\LoaiKhachHang::where('TenLoaiKhachHang', 'Khách hàng quen')->first();
        } else {
            $loaiKhach = \App\Models\LoaiKhachHang::where('TenLoaiKhachHang', 'Khách hàng thường')->first();
        }
        
        // Cập nhật loại khách (nếu tìm thấy)
        if ($loaiKhach) {
            $khachHang->idLoaiKhachHang = $loaiKhach->id;
            $khachHang->save();
        }
        

        return redirect()->route('QLdonhang.index')->with('success', 'Đã nhận thanh toán thành công.');
    }

    return redirect()->route('QLdonhang.index')->with('error', 'Không thể nhận thanh toán.');
}
public function baocao(Request $request){
    $query = $request->input('search'); 
    $from = $request->input('from_date');
    $to = $request->input('to_date');

    $dhs = DonHang::when($query, function ($q) use ($query) {
                $q->where('id', 'like', '%' . $query . '%');})->when($from, function ($q) use ($from) {
                $q->whereDate('NgayLap', '>=', $from); })->when($to, function ($q) use ($to) {
                $q->whereDate('NgayLap', '<=', $to);}) ->orderBy('id', 'asc')->get();
    $doanhThuTheoNgay = $dhs->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->NgayLap)->format('d-m-Y');
    })->map(function ($group) {
        return $group->sum('TongTienThanhToan');
    });
    return view('admin.donhang.baocaothongke', compact('dhs','doanhThuTheoNgay'));
}
}    
