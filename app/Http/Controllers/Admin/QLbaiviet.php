<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
class QLbaiviet extends Controller
{
    public function index(Request $request)
    {
        $query = BaiViet::query();

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where('TieuDe', 'like', '%' . $request->search . '%')
                  ->orWhere('TomTat', 'like', '%' . $request->search . '%');
        }

        // Phân trang bài viết (10 bài mỗi trang)
        $baiviet = $query->paginate(10);

        // Trả về view với dữ liệu
        return view('admin.QLbaiviet.index', compact('baiviet'));
    }
    public function create()
    {
        return view('admin.QLbaiviet.edit'); // Trả về view tạo bài viết
    }
    public function store(Request $request)
    {
      $request->validate([
            'TieuDe' => 'required|max:255',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'NoiDung' => 'required',
            'TomTat' => 'required|max:500',
        ],[
            'TieuDe.required' => 'Tiêu đề không được để trống',
            'HinhAnh.image' => 'Hình ảnh phải là một tệp hình ảnh',
            'HinhAnh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif',
            'HinhAnh.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            'NoiDung.required' => 'Nội dung không được để trống',
            'TomTat.required' => 'Tóm tắt không được để trống',
            'TomTat.max' => 'Tóm tắt không được vượt quá 500 ký tự',
        ]);
        $data = $request->only('TieuDe', 'NoiDung', 'TomTat');
        if ($request->hasFile('HinhAnh')) {
        $image = $request->file('HinhAnh');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/img/baiviet'), $filename);
        $data['HinhAnh'] = '/img/baiviet/'. $filename;
    }

        if (BaiViet::create($data)) {
            return redirect()->route('QLbaiviet.index')->with('success', 'Thêm bài viết thành công!');
        } else {
            return redirect()->back()->with('error', 'Vui lòng thử lại');
        }
    }
    public function edit($id)
{
    $baiviet = BaiViet::findOrFail($id); // Lấy bài viết theo ID
    return view('admin.QLbaiviet.edit', compact('baiviet')); // Trả về view chỉnh sửa
}
 /**
     * Cập nhật bài viết trong cơ sở dữ liệu.
     */

     public function update(Request $request, $id)
     {
         // Xác thực dữ liệu đầu vào
         $request->validate([
             'TieuDe' => 'required|max:255',
             'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'NoiDung' => 'required',
             'TomTat' => 'required|max:500',
         ],[
                'TieuDe.required' => 'Tiêu đề không được để trống',
                'HinhAnh.image' => 'Hình ảnh phải là một tệp hình ảnh',
                'HinhAnh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif',
                'HinhAnh.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
                'NoiDung.required' => 'Nội dung không được để trống',
                'TomTat.required' => 'Tóm tắt không được để trống',
                'TomTat.max' => 'Tóm tắt không được vượt quá 500 ký tự',
         ]);
     
         // Lấy bài viết cần cập nhật
         $baiviet = BaiViet::findOrFail($id);
     
         // Xử lý ảnh đại diện (nếu có)
         if ($request->hasFile('HinhAnh')) {
             // Xóa ảnh cũ nếu tồn tại
             if ($baiviet->HinhAnh && file_exists(public_path($baiviet->HinhAnh))) {
                 unlink(public_path($baiviet->HinhAnh));
             }
     
             // Lưu ảnh mới
             $image = $request->file('HinhAnh');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('/img/baiviet'), $filename);
             $baiviet->HinhAnh = '/img/baiviet/' . $filename;
         }
       $data = $request->only('TieuDe', 'NoiDung', 'TomTat');
       $data ['HinhAnh'] = $baiviet->HinhAnh; 
         
         if ($baiviet->update($data)) {
             return redirect()->route('QLbaiviet.index')->with('success', 'Cập nhật bài viết thành công!');
         } else {
             return redirect()->back()->with('error', 'Vui lòng thử lại');
         }
     
}
public function destroy($id)
{
    $baiviet = BaiViet::findOrFail($id); 
    
   
    if ($baiviet->HinhAnh && file_exists(public_path($baiviet->HinhAnh))) {
        unlink(public_path($baiviet->HinhAnh));
    }
    
    $baiviet->delete();

    return redirect()->route('QLbaiviet.index')->with('success', 'Xóa bài viết thành công!');
}
}
