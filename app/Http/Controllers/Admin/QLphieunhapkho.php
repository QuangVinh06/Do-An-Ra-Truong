<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use Illuminate\Http\Request;
use App\Models\PhieuNhapKho;
use App\Models\ChiTietPhieuNhap;
use App\Models\Kho;
use App\Models\SanPham;
use Illuminate\Support\Facades\Auth;

class QLphieunhapkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search'); 
        $pnks = PhieuNhapKho::with(['Kho'])
                ->when($query, function ($q) use ($query) {
                $q->where('NgayLap', 'like', '%' . $query . '%');
            })->orderBy('id', 'desc')->get();
        session()->forget('chi_tiet_nhap');
        session()->forget('sua_chi_tiet_nhap');
        return view('admin.QLkho.QLnhapkho', compact('pnks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kho = Kho::all();
        $sps = SanPham::all();
        return view('admin.QLkho.themphieunhapkho', compact('kho', 'sps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idKho' => 'required',
            'NguoiGiaoHang' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);
        $storeData = [
            'idKho' => $data['idKho'],
            'NguoiGiaoHang' => $data['NguoiGiaoHang'],
            'GhiChu' => $data['GhiChu'],
            'NgayLap' => now(),
            'NguoiLap' => Auth::guard('admin')->user()->name, // Giả sử bạn đang sử dụng auth để lấy người dùng hiện tại
        ];
        // Tạo phiếu nhập kho
        $phieuNhap = PhieuNhapKho::create($storeData);
        
        // Lấy danh sách chi tiết từ session (nếu có)
        $chiTietList = session('chi_tiet_nhap', []);
        // Thêm các chi tiết vào database
        foreach ($chiTietList as $chiTiet) {
            ChiTietPhieuNhap::create([
                'idPhieuNhap' => $phieuNhap->id,
                'idSanPham' => $chiTiet['idSanPham'],
                'SoLuong' => $chiTiet['SoLuong'],
            ]);
            // Cập nhật số lượng trong bảng sản phẩm
            $sanPham = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])
                ->where('idKho', $data['idKho'])
                ->first();
            if (!$sanPham) {
                ChiTietKho::create([
                    'idSanPham' => $chiTiet['idSanPham'],
                    'idKho' => $data['idKho'],
                    'SoLuong' => $chiTiet['SoLuong'],
                ]);
            }
            else {
                $sanPham->SoLuong += $chiTiet['SoLuong'];
                $sanPham->save();
            }
        }
        
        // Xóa session sau khi đã lưu
        session()->forget('chi_tiet_nhap');
        
        return redirect()->route('QLphieunhapkho.index')->with('success', 'Thêm phiếu nhập kho thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ct = ChiTietPhieuNhap::with('SanPham')
            ->where('idPhieuNhap', $id)->get();
        $phieunhap = PhieuNhapKho::find($id);
        return view('admin.QLkho.chitietphieunhap', compact('ct', 'phieunhap'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ct = ChiTietPhieuNhap::with('sanpham')->where('idPhieuNhap', $id)->get();
        $ts=session('sua_chi_tiet_nhap',[]);
        if(count($ts)==0) {
            $chiTietTemp = [];
            foreach($ct as $chitiet) {
                $chiTietTemp[] = [
                    'idSanPham' => $chitiet->idSanPham,
                    'SoLuong' => $chitiet->SoLuong,
                    'tenSanPham' => $chitiet->sanpham->TenGoi,
                    'tenLoai' => $chitiet->sanpham->loaisanpham->TenLoaiSanPham,
                    'tenMau' => $chitiet->sanpham->mau->TenMau,
                    'tenDonVi' => $chitiet->sanpham->donvitinh->TenDonViTinh
                ];
            }
            session(['sua_chi_tiet_nhap' => $chiTietTemp]);
        }
        $phieunhap = PhieuNhapKho::find($id);
        session(['sua_phieu_nhap' => $phieunhap]);
        $kho = Kho::all();
        $sps = SanPham::all();
        return view('admin.QLkho.suaphieunhapkho', compact('ct', 'phieunhap','kho', 'sps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate thông tin phiếu nhập
        $data = $request->validate([
            'idKho' => 'required',
            'NguoiGiaoHang' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);

        // Tìm phiếu nhập cần cập nhật
        $phieuNhap = PhieuNhapKho::findOrFail($id);
        
        // Cập nhật thông tin phiếu nhập
        $phieuNhap->update([
            'idKho' => $data['idKho'],
            'NguoiGiaoHang' => $data['NguoiGiaoHang'],
            'GhiChu' => $data['GhiChu'],
            // Không cập nhật NgayLap để giữ nguyên ngày lập ban đầu
        ]);

        // Lấy danh sách chi tiết từ session (nếu có)
        $chiTietList = session('sua_chi_tiet_nhap', []);
        
        if (!empty($chiTietList)) {
            // Hoàn trả số lượng của các chi tiết cũ
            $chiTietCu = ChiTietPhieuNhap::where('idPhieuNhap', $id)->get();
            foreach ($chiTietCu as $chiTiet) {
                $sanPham = ChiTietKho::where('idSanPham', $chiTiet->idSanPham)
                            ->where('idKho', $data['idKho'])->first();
                if ($sanPham) {
                    $sanPham->SoLuong -= $chiTiet->SoLuong;
                    $sanPham->save();
                }
            }
            
            // Xóa các chi tiết cũ
            ChiTietPhieuNhap::where('idPhieuNhap', $id)->delete();
            
            // Thêm các chi tiết mới
            foreach ($chiTietList as $chiTiet) {
                ChiTietPhieuNhap::create([
                    'idPhieuNhap' => $phieuNhap->id,
                    'idSanPham' => $chiTiet['idSanPham'],
                    'SoLuong' => $chiTiet['SoLuong'],
                ]);
                
                // Cập nhật số lượng trong bảng sản phẩm
                $sanPham = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])
                            ->where('idKho', $data['idKho'])->first();
                
                if (!$sanPham) {
                    ChiTietKho::create([
                        'idSanPham' => $chiTiet['idSanPham'],
                        'idKho' => $data['idKho'],
                        'SoLuong' => $chiTiet['SoLuong'],
                    ]);
                } else {
                    $sanPham->SoLuong += $chiTiet['SoLuong'];
                    $sanPham->save();
                }
            }
            
            // Xóa session sau khi đã lưu
            session()->forget('sua_chi_tiet_nhap');
        }
        
        return redirect()->route('QLphieunhapkho.index')->with('success', 'Cập nhật phiếu nhập kho thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phieuNhap = PhieuNhapKho::find($id);
        $chiTietNhapKho = ChiTietPhieuNhap::where('idPhieuNhap', $id)->get();
        foreach ($chiTietNhapKho as $chiTiet) {
            $sanPham = ChiTietKho::where('idSanPham', $chiTiet->idSanPham)
                        ->where('idKho', $phieuNhap->idKho)->first();
            if ($sanPham) {
                $sanPham->SoLuong -= $chiTiet->SoLuong;
                $sanPham->save();
            }
            $chiTiet->delete();
        }
        $phieuNhap->delete();
        return redirect()->route('QLphieunhapkho.index')->with('success', 'Xóa phiếu nhập kho thành thông');
    }
}
