<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maus;
use App\Models\DonViTinh;
class ColorController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $data = Maus::where(function($query) use ($search) {
            $query->where('id', 'LIKE', '%'.$search.'%')
                  ->orWhere('TenMau', 'LIKE', '%'.$search.'%');
        })
        ->orderBy('id', 'DESC')
        ->paginate(5);

     return view('admin.color.index', compact('data'));

     
    }

    public function store(Request $request){
            
        $request -> validate([
            'id'=> 'required',
            'TenMau' => 'required',
            'HinhAnh'=>'required|file|mimes:jpg,png,jpeg,gif'
    ],[
         
       
         'TenMau.required'=>'Hãy nhập tên màu'  ,
         'HinhAnh.mimes' =>'Hãy chọn ảnh đúng định dạng đuôi jpg,png,jpeg,gif',
         'HinhAnh.required' =>'Hãy chọn ảnh'
     ]);

     $data= $request->only('id','TenMau');
     $request->hasFile('HinhAnh') ;
        $img_name = time() . '_' . $request->HinhAnh->getClientOriginalName(); 
        $request->HinhAnh->move(public_path('/storage/images'), $img_name);
        $data['HinhAnh'] = $img_name;
        if( Maus::create($data)){
            return redirect()->route('color.index')->with('success', 'Thêm màu thành công!');
       
        }
        else{
            return redirect()->back()->with('error','vui lòng thử lại');
        }
       
       
             
    }

    public function create() {
    
    }
    public function show($id) {
    
    }


    public function edit($id) {
       
    }

    public function update(Request $request, $id) {
        $request->validate([
            'TenMau' => 'required|string|max:255',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $color = Maus::find($id);
        if (!$color) {
            return redirect()->back()->with('error', 'Không tìm thấy màu!');
        }   
        $color->TenMau = $request->TenMau;
        if ($request->hasFile('HinhAnh')) {
            if ($color->HinhAnh && file_exists(public_path('storage/images/' . $color->HinhAnh))) {
                unlink(public_path('storage/images/' . $color->HinhAnh));
            }    
            $imageName = time().'.'.$request->HinhAnh->getClientOriginalName(); ;
            $request->HinhAnh->move(public_path('storage/images'), $imageName);
            $color->HinhAnh = $imageName;
        }
        $color->save();
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id) {
        // Tìm bản ghi cần xóa
        $mau = Maus::find($id);
        // Kiểm tra nếu không tìm thấy
        if (!$mau) {
            return redirect()->back()->with('error', 'Không tìm thấy màu để xóa!');
        }
        
        // Thử xóa
        try {
            $imagePath = public_path('storage/images/' . $mau->HinhAnh);
            // Kiểm tra nếu ảnh tồn tại thì xóa
            if (file_exists($imagePath) && !empty($mau->HinhAnh)) {
                unlink($imagePath); // Xóa ảnh từ thư mục
            }
            $mau->delete();
            return redirect()->route('color.index')->with('success', 'Xóa thành công!');
        } catch (\Exception $e) {
            
            if ($e->getCode() == 23000) {
                // Lỗi ràng buộc foreign key
                return redirect()->back()->with('error', 'Không được phép xoá màu vì đã được liên kết với sản phẩm.');
            }
    
        }
    }
}
