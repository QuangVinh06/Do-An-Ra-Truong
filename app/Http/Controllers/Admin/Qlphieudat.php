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
        })->orderBy('id', 'desc')->paginate(5);
        return view('admin.QLdathang.qlphieudat', compact('pds'));
    }
    public function show(string $id)
    {
        $dat = PhieuDatHang::with('khuyenmai')->findOrFail($id);
        $ctdat = ChiTietPhieuDatHang::with('sanPham')->where('idPhieuDat', $id)->get();
    
        $tongTienGoc = $ctdat->sum('ThanhTien');
        $tongTienSauGiam = $dat->TongTien;
        $tienGiam = $tongTienGoc - $tongTienSauGiam;
    
        $TenKhuyenMai = $dat->khuyenmai?->TenKhuyenMai ?? 'Không có giảm giá';
        $GiamGia = $dat->khuyenmai?->GiamGia ?? 0;
    
        return view('admin.QLdathang.ctphieudat', compact('dat', 'ctdat', 'tongTienGoc', 'tongTienSauGiam', 'tienGiam', 'TenKhuyenMai', 'GiamGia'));
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
