<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuDatHang;
use App\Models\ChiTietPhieuDatHang;
class Qlphieudat extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search'); 
        $pds = PhieuDatHang::when($query, function ($q) use ($query) {
                $q->where('id', 'like', '%' . $query . '%');
        })->orderBy('id', 'desc')->get();
        return view('admin.QLdathang.qlphieudat', compact('pds'));
    }
    public function show2(string $id)
 {
     $user = Auth::guard('web')->user();
     if (!$user) {
         return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
     }
 
     // Lấy khách hàng từ user
     $khachHang = KhachHang::whereHas('user', function ($query) use ($user) {
         $query->where('id', $user->id);
     })->firstOrFail();
 
     // Lấy phiếu đặt hàng theo ID (đơn hàng cụ thể), bao gồm cả khuyến mãi
     $phieuDat = PhieuDatHang::with('khuyenmai')->where('id', $id)->where('idKhachHang', $khachHang->id)->firstOrFail();
 
     // Lấy chi tiết đặt hàng kèm quan hệ sản phẩm nếu cần
     $ctdat = ChiTietPhieuDatHang::with('sanpham')->where('idPhieuDat', $id)->get();
 
     // Lấy thông tin khuyến mãi (nếu có)
     $TenKhuyenMai = $phieuDat->khuyenmai?->TenKhuyenMai ?? 'Không có';
     $GiamGia = $phieuDat->khuyenmai?->GiamGia ?? 0;
 
     // Tính tổng tiền sản phẩm trước giảm (tổng các dòng chi tiết)
     $tongTienGoc = $ctdat->sum('ThanhTien');
 
     // Tổng tiền sau giảm đã lưu trong phiếu
     $tongTienSauGiam = $phieuDat->TongTien;
 
     // Tính số tiền được giảm (chênh lệch)
     $tienGiam = $tongTienGoc - $tongTienSauGiam;
 
     return view('admin.QLdathang.ctphieudat', compact(
         'ctdat',
         'TenKhuyenMai',
         'GiamGia',
         'tongTienGoc',
         'tienGiam',
         'tongTienSauGiam'
     ));
 }
    public function xacNhan($id)
{
    $phieuDat = PhieuDatHang::findOrFail($id);

    if ($phieuDat->TrangThai === 0) {
        $phieuDat->TrangThai = 1; // Chuyển trạng thái sang 1
        $phieuDat->save();
    }

    return redirect()->route('qlphieudat.index')->with('success', 'Phiếu đặt hàng đã được xác nhận.');
}
    public function destroy($id)
    {
        $phieuDat = PhieuDatHang::findOrFail($id);
        $phieuDat->delete();
        return redirect()->route('qlphieudat.index')->with('success', 'Xóa phiếu đặt hàng thành công.');
    }
}
