<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiSanPham;
use Illuminate\Http\Request;

class ProductCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = LoaiSanPham::where(function($query) use ($search) {
                $query->where('TenLoaiSanPham', 'LIKE', '%'.$search.'%');
                      
            })
            ->orderBy('id', 'DESC')
            ->paginate(5);
    
      
        return view('admin.productcategory.index',compact('data'));
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
        $request -> validate([
            'id' => 'required|integer|unique:loai_san_phams',
            'TenLoaiSanPham' => 'required'
            
    ],[
         'id.required' => 'hãy nhập mã loại sản phẩm!',
         'id.unique' => 'Mã loại sản phẩm này đã tồn tại!', 
         'id.integer' => 'không đúng định dạng',  
         'TenLoaiSanPham.required'=>'Hãy nhập tên loại sản phẩm'  ,
        
     ]);

     $data= $request->only('id','TenLoaiSanPham');
        if( LoaiSanPham::create($data)){
            return redirect()->route('productcategory.index')->with('success', 'Thêm thành công!');
       
        }
        else{
            return redirect()->back()->with('error','vui lòng thử lại');
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(LoaiSanPham $loaiSanPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoaiSanPham $loaiSanPham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'id'=>'required',
            'TenLoaiSanPham' => 'required|string|max:255'
        ],[
            'id.required' => 'ID loại sản phẩm không được để trống',
            'TenLoaiSanPham.required' => 'Tên loại sản phẩm không được để trống',
        ]);
        $loaisanpham = LoaiSanPham::find($id);
        if (!$loaisanpham) {
            return redirect()->back()->with('error', 'Không tìm thấy loại sản phẩm!');
        }   
        $loaisanpham->TenLoaiSanPham = $request->TenLoaiSanPham;
        
        $loaisanpham->save();
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $loaisanpham = LoaiSanPham::find($id);
        // Kiểm tra nếu không tìm thấy
        if (!$loaisanpham) {
            return redirect()->back()->with('error', 'Không tìm thấy loại sản phẩm để xóa!');
        }
        // Thử xóa
        try {
           
            $loaisanpham->delete();
            return redirect()->route('productcategory.index')->with('success', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
