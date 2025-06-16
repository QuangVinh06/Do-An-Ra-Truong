<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietPhieuNhap;
use App\Models\Kho;
use App\Models\SanPham;
use Illuminate\Http\Request;

class QLChiTietThemNhapKho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('QLphieunhapkho.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idSanPham' => 'required',
            'SoLuong' => 'required|numeric|min:1',
        ]);
        
        // Lấy thông tin sản phẩm
        $sanPham = SanPham::find($data['idSanPham']);
        
        if (!$sanPham) {
            return back()->with('error', 'Sản phẩm không tồn tại');
        }
        
        // Lấy danh sách chi tiết hiện tại từ session
        $chiTietList = session('chi_tiet_nhap', []);
        
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách chưa
        foreach ($chiTietList as &$chiTiet) {
            if ($chiTiet['idSanPham'] == $data['idSanPham']) {
                $chiTiet['SoLuong'] += $data['SoLuong'];
                session(['chi_tiet_nhap' => $chiTietList]);
                return redirect()->route('QLphieunhapkho.create')->with('success', 'Đã cập nhật số lượng sản phẩm trong danh sách');
            }
        }
        // Thêm chi tiết mới vào danh sách
        $chiTietList[] = [
            'id' => count($chiTietList) + 1,
            'idSanPham' => $data['idSanPham'],
            'SoLuong' => $data['SoLuong'],
            'tenSanPham' => $sanPham->TenGoi,
            'tenLoai' => $sanPham->loaisanpham->TenLoaiSanPham,
            'tenMau' => $sanPham->mau->TenMau,
            'tenDonVi' => $sanPham->donvitinh->TenDonViTinh,
        ];
        
        // Lưu lại vào session
        session(['chi_tiet_nhap' => $chiTietList]);
        return redirect()->route('QLphieunhapkho.create')->with('success', 'Đã thêm sản phẩm vào danh sách');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietPhieuNhap $chiTietPhieuNhap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chiTietList = session('chi_tiet_nhap', []);
        foreach ($chiTietList as $key => $chiTiet) {
            if ($chiTiet['idSanPham'] == $id) {
                $sanpham = $chiTiet;
                $kho = Kho::all();
                $sps = SanPham::all();
                return view('admin.QLkho.themphieunhapkho', compact('sanpham','kho', 'sps','key'));
            }
        }
        return redirect()->route('QLphieunhapkho.create')->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'SoLuong' => 'required|numeric|min:1',
            'idSanPham' => 'required',
        ]);
        $sanPham = SanPham::find($data['idSanPham']);
        $chiTietList = session('chi_tiet_nhap', []);
        if (isset($chiTietList[$id])) {
            if ($chiTietList[$id]['idSanPham'] != $data['idSanPham']) {
                foreach ($chiTietList as &$chiTiet) {
                    if ($chiTiet['idSanPham'] == $data['idSanPham']) {
                        unset($chiTietList[$id]);
                        $chiTiet['SoLuong'] += $data['SoLuong'];
                        session(['chi_tiet_nhap' => $chiTietList]);
                        return redirect()->route('QLphieunhapkho.create')->with('success', 'Đã cộng dồn số lượng sản phẩm trong danh sách');
                    }
                }
            }
            $chiTietList[$id] = [
            'idSanPham' => $data['idSanPham'],
            'tenSanPham'=> $sanPham->TenGoi,
            'tenLoai' => $sanPham->loaisanpham->TenLoaiSanPham,
            'tenMau' => $sanPham->mau->TenMau,
            'tenDonVi' => $sanPham->donvitinh->TenDonViTinh,
            'SoLuong' => $data['SoLuong'],
            ];
            session(['chi_tiet_nhap' => $chiTietList]);
            return redirect()->route('QLphieunhapkho.create')->with('success', 'Đã cập nhật sản phẩm');
        }
        return redirect()->route('QLphieunhapkho.create')->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chiTietList = session('chi_tiet_nhap', []);
        foreach ($chiTietList as $key => $chiTiet) {
            if ($chiTiet['idSanPham'] == $id) {
                unset($chiTietList[$key]);
                session(['chi_tiet_nhap' => array_values($chiTietList)]);
                return redirect()->route('QLphieunhapkho.create')->with('success', 'Đã xóa sản phẩm khỏi danh sách');
            }
        }
        return redirect()->route('QLphieunhapkho.create')->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }
}
