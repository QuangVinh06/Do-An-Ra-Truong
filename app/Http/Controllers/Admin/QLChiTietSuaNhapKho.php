<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietPhieuNhap;
use App\Models\Kho;
use App\Models\PhieuNhapKho;
use App\Models\SanPham;
use Illuminate\Http\Request;

class QLChiTietSuaNhapKho extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idSanPham' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'idPhieuNhap' => 'required',
        ]);
        
        // Lấy thông tin sản phẩm
        $sanPham = SanPham::find($data['idSanPham']);
        
        if (!$sanPham) {
            return back()->with('error', 'Sản phẩm không tồn tại');
        }
        
        // Lấy danh sách chi tiết hiện tại từ session
        $chiTietList = session('sua_chi_tiet_nhap', []);
        
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách chưa
        foreach ($chiTietList as $index =>$chiTiet) {
            if ($chiTiet['idSanPham'] == $data['idSanPham']) {
                $chiTietList[$index]['SoLuong'] += $data['SoLuong'];
                session(['sua_chi_tiet_nhap' => $chiTietList]);
                return redirect()->route('QLphieunhapkho.edit', $data['idPhieuNhap'])->with('success', 'Đã cập nhật số lượng sản phẩm vào danh sách');;
            }
        }
        // Thêm chi tiết mới vào danh sách
        $chiTietList[] = [
            'id' => count($chiTietList) + 1,
            'idSanPham' => $data['idSanPham'],
            'idBangMau' => $sanPham->mau->TenMau,
            'SoLuong' => $data['SoLuong'],
            'tenSanPham' => $sanPham->TenGoi,
            'tenLoai' => $sanPham->loaisanpham->TenLoaiSanPham,
            'tenDonVi' => $sanPham->donvitinh->TenDonViTinh,
        ];
        
        // Lưu lại vào session
        session(['sua_chi_tiet_nhap' => $chiTietList]);
        return redirect()->route('QLphieunhapkho.edit', $data['idPhieuNhap'])->with('success', 'Đã thêm sản phẩm vào danh sách');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ct = ChiTietPhieuNhap::with('sanpham')->where('idPhieuNhap', $id)->get();
        $phieunhap = PhieuNhapKho::find($id);
        $kho = Kho::all();
        $sps = SanPham::all();
        return view('admin.QLkho.suaphieunhapkho', compact('kho', 'sps','id','phieunhap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chiTietList = session('sua_chi_tiet_nhap', []);
        $phieunhap = session('sua_phieu_nhap');
        if (isset($chiTietList[$id])) {
            
            $sanpham = $chiTietList[$id];
            $kho = Kho::all();
            $sps = SanPham::all();
            return view('admin.QLkho.suaphieunhapkho', compact('sanpham','kho', 'sps','id','phieunhap'));
        }
        return redirect()->route('QLphieunhapkho.edit',$phieunhap->id)->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'SoLuong' => 'required|numeric|min:1',
            'idPhieuNhap' => 'required',
        ]);
        $chiTietList = session('sua_chi_tiet_nhap', []);
        if (($chiTietList[$id])) {
            $chiTietList[$id]['SoLuong'] = $data['SoLuong'];
            session(['sua_chi_tiet_nhap' => $chiTietList]);
            return redirect()->route('QLphieunhapkho.edit', $data['idPhieuNhap'])->with('success', 'Đã cập nhật số lượng');
        }
        return redirect()->route('QLphieunhapkho.edit', $data['idPhieuNhap'])->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhieuNhapKho $phieuNhapKho)
    {
        //
    }
}
