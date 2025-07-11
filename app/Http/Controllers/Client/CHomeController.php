<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PhanHoiKhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KhachHang;
use App\Models\SanPham;
use App\Models\KhuyenMai;
use App\Models\LoaiSanPham;
use App\Models\BaiViet;
class CHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        $sanpham = SanPham::with(['LoaiSanPham', 'banggia'])->latest()->get();
        $productcategory = LoaiSanPham::all();
        $huongdan = BaiViet::latest()->take(3)->get();
       return view('client.home',compact('user','sanpham','productcategory','huongdan'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
   
}
