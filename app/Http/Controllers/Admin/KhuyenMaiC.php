<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhuyenMai;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use App\Models\BaiViet;
use App\Models\LoaiKhachHang;
class KhuyenMaiC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $khuyenMais = KhuyenMai::with('loaiKhachHang')
                        ->when($query, function ($q) use ($query) {
            $q->where('TenKhuyenMai', 'like', '%' . $query . '%');
            })->where('TrangThai', 1)->orderBy('id', 'desc')->get();

             $sanpham = SanPham::with(['LoaiSanPham', 'banggia'])->latest()->get();



        $loaikhachhang = LoaiKhachHang::all();
        $productcategory = LoaiSanPham::orderBy('id', 'DESC')->get();
        $huongdan = BaiViet::latest()->get();
        return view('client.khuyenmai', compact('khuyenMais', 'sanpham', 'productcategory', 'huongdan', 'loaikhachhang'));

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KhuyenMai $khuyenMai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KhuyenMai $khuyenMai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KhuyenMai $khuyenMai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhuyenMai $khuyenMai)
    {
        //
    }
}
