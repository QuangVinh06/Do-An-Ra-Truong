<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiKhachHang;
class QlLoaiKhachHang extends Controller
{
    public function index(Request $request)
    {               
        $query = $request->input('search');
        $lkhs = LoaiKhachHang::when($query, function ($q) use ($query) {
            $q->where('TenLoaiKhachHang', 'like', "%{$query}%");
            })->orderBy('id', 'desc')->get();
        return view('admin.QLloaikhachhang.index', compact('lkhs'));
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
            'TenLoaiKhachHang' => 'required|string|max:255',
            'DieuKien' => 'required|integer'
        ],[
            'TenLoaiKhachHang.required' => 'Tên loại khách hàng không được để trống.',
            'DieuKien.required' => 'Điều kiện không được để trống.',
            'TenLoaiKhachHang.max' => 'Tên loại khách hàng không được vượt quá 255 ký tự.'
        ]);
        $storeData = [
            'TenLoaiKhachHang' => $data['TenLoaiKhachHang'],
            'DieuKien' => $data['DieuKien']
        ];
      if(  LoaiKhachHang::create($storeData)  ){
            return redirect()->route('loaikhachhang.index')->with('success', 'Thêm loại khách hàng thành công.');
        }
        else{
            return redirect()->back()->with('error', 'Vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LoaiKhachHang $loaiKhachHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loaikhachhang = LoaiKhachHang::findOrFail($id);
        $lkhs = LoaiKhachHang::all();
        return view('admin.QLloaikhachhang.index', compact('loaikhachhang','lkhs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loaikhachhang = LoaiKhachHang::findOrFail($id);
        
        $data = request()->validate([
            'TenLoaiKhachHang' => 'required|string',
            'DieuKien' => 'required|integer'
        ],[
            'TenLoaiKhachHang.required' => 'Tên loại khách hàng không được để trống.',
            'DieuKien.required' => 'Điều kiện không được để trống.',
            'TenLoaiKhachHang.max' => 'Tên loại khách hàng không được vượt quá 255 ký tự.'
        ]);
        $storeData = [
            'TenLoaiKhachHang' => $data['TenLoaiKhachHang'],
            'DieuKien' => $data['DieuKien']
        ];

    
        if ( $loaikhachhang->update($storeData)) {
             return redirect()->route('QLloaikhachhang.index')
            ->with('success', 'Cập nhật loại khách hàng thành công.');
        }
      else {
            return redirect()->back()
            ->with('error', 'Cập nhật loại khách hàng thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loaikhachhang = LoaiKhachHang::findOrFail($id);
        $loaikhachhang->delete();
        
        return redirect()->back()
            ->with('success', 'Xóa loại khách hàng thành công.');
    }
}
