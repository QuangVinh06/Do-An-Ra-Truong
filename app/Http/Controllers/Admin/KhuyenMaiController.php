<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use App\Models\LoaiKhachHang;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()

{   $loaiKhachHang = LoaiKhachHang::all();
    $khuyenMai= KhuyenMai::with('loaiKhachHang')->get();
   
    return view('admin.QLkhuyenmai.index', compact('khuyenMai','loaiKhachHang'));
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
        'id' => 'required|unique:khuyen_mais,id',
        'TenKhuyenMai' => 'required|unique:khuyen_mais,TenKhuyenMai',
        'GiamGia' => 'required|numeric|min:0|max:100',
        'idLoaiKhachHang' => 'required|exists:loai_khach_hangs,id',
         'NgayBatDau' => 'required|date|after_or_equal:today',
         'NgayKetThuc' => 'required|date|after_or_equal:NgayBatDau',
    ],[
        'id.unique' => 'mã đã tồn tại',
        'id.required' => 'ID không được để trống',
        'TenKhuyenMai.required' => 'Tên khuyến mãi không được để trống',
        'GiamGia.required' => 'Giảm giá không được để trống',
        'GiamGia.numeric' => 'Giảm giá phải là số',
        'GiamGia.min' => 'Giảm giá phải lớn hơn hoặc bằng 0',
        'GiamGia.max' => 'Giảm giá không được vượt quá 100%',
        'idLoaiKhachHang.required' => 'Loại khách hàng không được để trống',
        'idLoaiKhachHang.exists' => 'Loại khách hàng không tồn tại',
        'TenKhuyenMai.unique' => 'Tên khuyến mãi đã tồn tại',   
        'NgayBatDau.required' => 'Ngày bắt đầu không được để trống',
        'NgayKetThuc.required' => 'Ngày kết thúc không được để trống',
        
        'NgayBatDau.after_or_equal' => 'Ngày bắt đầu không được trước ngày hôm nay',
        'NgayKetThuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
    ]);
     $khuyenmaiDangHoatDong = KhuyenMai::where('idLoaiKhachHang', $request->idLoaiKhachHang)
    ->where('TrangThai', 1)
    ->first();

if ($khuyenmaiDangHoatDong) {
    return redirect()->back()->with('error', 'Loại khách hàng này đã có khuyến mãi đang hoạt động!');
}
    if( KhuyenMai::create($request->only([
    'id', 'TenKhuyenMai', 'GiamGia', 'idLoaiKhachHang', 'NgayBatDau', 'NgayKetThuc'
]))) {
           return redirect()->back()->with('success', 'Thêm khuyến mãi thành công!');
    } else {
        return redirect()->back()->with('error', 'Thêm khuyến mãi thất bại!');
    }
  

 
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
  public function edit($id)
{
    $khuyenmai = KhuyenMai::findOrFail($id);
    $loaiKhachHang = LoaiKhachHang::all();
    $khuyenMai = KhuyenMai::with('loaiKhachHang')->get();
    return view('admin.QLkhuyenmai.index', compact('khuyenmai', 'khuyenMai', 'loaiKhachHang'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $khuyenMai = KhuyenMai::findOrFail($id);
    $request->validate([
        'TenKhuyenMai' => 'required|unique:khuyen_mais,TenKhuyenMai,' . $id,
        'GiamGia' => 'required|numeric|min:0|max:100',
        'idLoaiKhachHang' => 'required|exists:loai_khach_hangs,id',
       'NgayBatDau' => 'required|date|after_or_equal:today',
        'NgayKetThuc' => 'required|date|after_or_equal:NgayBatDau',
    ],[
        'TenKhuyenMai.required' => 'Tên khuyến mãi không được để trống',
        'GiamGia.required' => 'Giảm giá không được để trống',
        'GiamGia.numeric' => 'Giảm giá phải là số',
        'GiamGia.min' => 'Giảm giá phải lớn hơn hoặc bằng 0',
        'GiamGia.max' => 'Giảm giá không được vượt quá 100%',
        'idLoaiKhachHang.required' => 'Loại khách hàng không được để trống',
        'idLoaiKhachHang.exists' => 'Loại khách hàng không tồn tại',
        'TenKhuyenMai.unique' => 'Tên khuyến mãi đã tồn tại',
        'NgayBatDau.required' => 'Ngày bắt đầu không được để trống',
        'NgayKetThuc.required' => 'Ngày kết thúc không được để trống',
        'NgayBatDau.after_or_equal' => 'Ngày bắt đầu phải là ngày hôm nay trở lên',
        'NgayKetThuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
    ]
);

 
    $khuyenmaiDangHoatDong = KhuyenMai::where('idLoaiKhachHang', $request->idLoaiKhachHang)
    ->where('TrangThai', 1)
    ->where('id', '!=', $id)
    ->first();

if ($khuyenmaiDangHoatDong) {
    return redirect()->back()->with('error', 'Loại khách hàng này đã có khuyến mãi đang hoạt động!');
}

     if ($khuyenMai->update($request->only([
        'TenKhuyenMai', 'GiamGia', 'idLoaiKhachHang', 'NgayBatDau', 'NgayKetThuc'
    ]))) {
        return redirect()->route('QLkhuyenmai.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    } else {
        return redirect()->back()->with('error', 'Cập nhật khuyến mãi thất bại!');
    }
}

/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $khuyenMai = KhuyenMai::findOrFail($id);
    $khuyenMai->delete();
    return redirect()->route('QLkhuyenmai.index')->with('success', 'Xóa khuyến mãi thành công!');
}
}
