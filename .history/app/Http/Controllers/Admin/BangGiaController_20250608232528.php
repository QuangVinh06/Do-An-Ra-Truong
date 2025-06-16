<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BangGia;
use Illuminate\Http\Request;
use App\Models\SanPham;
class BangGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sps = SanPham::with('banggia')->get();

        $bg = BangGia::all();
        return view('admin.Baogia.index', compact('sps','bg'));
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
        $data = $request->validate([
            'GhiChu' => 'required|string',
            'Gia'=>'required|numeric|min:10000',
            'idSanPham' => 'exists:san_phams,id',
        ]);

        $storeData = [
            'GhiChu' => $data['GhiChu'],
            'Gia' => $data['Gia'],
            'idSanPham' => $data['idSanPham'],
            'NgayLap'=>now()
        ];
        
         BangGia::create($storeData);
 

        return redirect()->route('Baogia.index')->with('success', 'Thêm bảng giá thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(BangGia $bangGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $banggia = BangGia::find($id);
        $sps = SanPham::with('banggia')->get();
        $bg = BangGia::with('sanpham')->orderBy('id', 'desc')->get();
        return view('Baogia.index', compact('bg','banggia', 'sps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $banggia = BangGia::find($id);
        $data = $request->validate([
            'GhiChu' => 'required|string',
            'Gia'=>'required|numeric|min:10000',
            'idSanPham' => 'exists:san_phams,id',
        ]);

        $updateData = [
            'GhiChu' => $data['GhiChu'],
            'Gia' => $data['Gia'],
            'idSanPham' => $data['idSanPham'],
            'NgayLap'=>now()
        ];
        
        $banggia->update($updateData);
       
        return redirect()->route('Baogia.index')->with('success', 'Cập nhật bảng giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banggia = BangGia::find($id);
        $banggia->delete();
        return redirect()->route('Baogia.index')->with('success', 'Xóa bảng giá thành công'); 
    }
}
