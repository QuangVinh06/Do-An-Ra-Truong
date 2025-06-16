<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kho;
use App\Models\PhieuNhapKho;
use App\Models\SanPham;
use App\Models\ChiTietPhieuNhap;
use Illuminate\Support\Facades\DB;

class Themphieunhapkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $KhoList = Kho::all();
        $SanPhamList = SanPham::all();
        return view('admin.QLNhapkho.nhapkho', compact('KhoList', 'SanPhamList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NguoiGiaoHang' => 'required',
            'MaKho' => 'required',
            'GhiChu' => 'required'

        ],[
            'NguoiGiaoHang.required' => 'Hãy nhập tên người giao hàng',
            'MaKho.required' => 'Hãy chọn mã kho',
            'GhiChu.required' => 'nhập ghi chú'
        ]);
        
        DB::beginTransaction();
        
        try {
            $phieuNhap = PhieuNhapKho::create([
                'NgayLap' => now(),
                'NguoiGiaoHang' => $request->NguoiGiaoHang,
                'idKho' => $request->MaKho,
                'GhiChu' => $request->GhiChu
            ]);
            
            // Nếu có sản phẩm được gửi từ form
            if ($request->has('san_pham')) {
                foreach ($request->san_pham as $index => $sp) {
                    $maSanPham = $sp['MaSanPham'];
                    $soLuong = $sp['SoLuong'];
                    
                    // Tạo chi tiết nhập kho
                    ChiTietPhieuNhap::create([
                        'idPhieuNhapKho' => $phieuNhap->id,
                        'idSanPham' => $maSanPham,
                        'SoLuong' => $soLuong
                    ]);
                    
                    // Cập nhật số lượng sản phẩm
                    $sanPham = SanPham::find($maSanPham);
                    $sanPham->SoLuong += $soLuong;
                    $sanPham->save();
                }
            }
            
            DB::commit();
            return redirect()->route('QLphieunhapkho.index')->with('success', 'Tạo phiếu nhập kho thành công');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanPham = SanPham::find($id);
        return response()->json($sanPham);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chiTiet = ChiTietPhieuNhap::find($id);
        
        if (!$chiTiet) {
            return response()->json(['error' => 'Không tìm thấy chi tiết nhập kho'], 404);
        }
        
        // Lấy số lượng cũ để tính toán điều chỉnh kho
        $soLuongCu = $chiTiet->SoLuong;
        
        $chiTiet->MaSanPham = $request->MaSanPham;
        $chiTiet->SoLuong = $request->SoLuong;
        $chiTiet->save();
        
        // Cập nhật số lượng sản phẩm trong kho
        $sanPham = SanPham::find($request->MaSanPham);
        $sanPham->SoLuong = $sanPham->SoLuong - $soLuongCu + $request->SoLuong;
        $sanPham->save();
        
        return response()->json(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chiTiet = ChiTietPhieuNhap::find($id);
        
        if (!$chiTiet) {
            return response()->json(['error' => 'Không tìm thấy chi tiết nhập kho'], 404);
        }
        
        // Cập nhật lại số lượng sản phẩm
        $sanPham = SanPham::find($chiTiet->MaSanPham);
        $sanPham->SoLuong -= $chiTiet->SoLuong;
        $sanPham->save();
        
        $chiTiet->delete();
        
        return response()->json(['success' => 'Xóa thành công']);
    }
}
