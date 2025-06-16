<?php

namespace App\Http\Controllers\Admin;
use App\Models\PhieuDatHang;
use App\Models\DonHang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use App\Models\LoaiKhachHang;
class QLKhachHang extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        $khachHang = KhachHang::with('user', 'loaikhachhang') // Load quan hệ luôn
            ->when($query, function ($q) use ($query) {
                $q->whereHas('loaikhachhang', function ($subQuery) use ($query) {
                    $subQuery->where('TenLoaiKhachHang', 'like', "%{$query}%");
                })->orWhereHas('user', function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', "%{$query}%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();
    
        return view('admin.QLthongtinkhachhang.index', compact('khachHang'));
    }
  public function capNhatLoaiKhachHang($khachHangId)
{
    $khachHang = KhachHang::findOrFail($khachHangId);
    $soDonDaMua = $khachHang->donHang->count();

    // Tìm loại khách hàng phù hợp nhất (Điều kiện <= số đơn đã mua, ưu tiên điều kiện cao nhất)
    $loai = LoaiKhachHang::where('DieuKien', '<=', $soDonDaMua)
        ->orderByDesc('DieuKien')
        ->first();

    if ($loai) {
        $khachHang->idLoaiKhachHang = $loai->id; // hoặc $khachHang->LoaiKhachHang nếu đúng tên cột
        $khachHang->save();
        return response()->json([
            'message' => 'Cập nhật loại khách hàng thành công!',
            'LoaiKhachHang' => $loai->TenLoaiKhachHang
        ]);
    } else {
        return response()->json([
            'message' => 'Không tìm thấy loại khách hàng phù hợp!'
        ], 404);
    }
}
    public function baocao(Request $request){
        $customerId = $request->input('customer_id');
        $customerName = $request->input('customer_name');
        $customerType = $request->input('customer_type');
    
        $khachHang = KhachHang::with('user', 'loaikhachhang')
            ->when($customerId, function ($q) use ($customerId) {
                $q->where('id', $customerId);
            })
            ->when($customerName, function ($q) use ($customerName) {
                $q->whereHas('user', function ($subQuery) use ($customerName) {
                    $subQuery->where('name', 'like', "%{$customerName}%");
                });
            })
            ->when($customerType, function ($q) use ($customerType) {
                $q->whereHas('loaikhachhang', function ($subQuery) use ($customerType) {
                    $subQuery->where('TenLoaiKhachHang', 'like', "%{$customerType}%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();
    
        return view ('admin.QLthongtinkhachhang.baocaothongkekhachhang', compact('khachHang'));
    }
    public function xemDonHang(Request $request, $email)
    {
        $admin = Auth::guard('admin')->user();
    
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors('Vui lòng đăng nhập với tư cách admin.');
        }
    
        $donHangs = \App\Models\DonHang::whereHas('hopDong.phieuDatHang', function ($query) use ($email) {
            $query->where('Email', $email);
            })
            ->whereDoesntHave('chiTietDoiTra')
            ->orderBy('NgayLap', 'desc')
            ->get();
        return view('admin.QLthongtinkhachhang.donhang', compact('donHangs', 'email'));
    }
    
    public function xemctDonHang(Request $request,$id){
        
        $dh = DonHang::findOrFail($id);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('admin.QLthongtinkhachhang.ctdonhang',compact('dh','PhieuDat'));
    }
}