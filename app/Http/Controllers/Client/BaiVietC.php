<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
class BaiVietC extends Controller
{
    public function index(Request $request)
 
    {
        
        $query = BaiViet::query();
        $baiviet =  BaiViet::orderBy('updated_at', 'desc')->paginate(5);
            $ids = $baiviet->pluck('id')->toArray();

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where('TieuDe', 'like', '%' . $request->search . '%')
                  ->orWhere('TomTat', 'like', '%' . $request->search . '%');
        }
      $baiviet_lienquan = BaiViet::whereNotIn('id', $ids)
        ->orderBy('updated_at', 'desc')
        ->take(3)
        ->get();
       
        return view('client.baiviet', compact('baiviet', 'baiviet_lienquan'));
    }
    public function show($id){
         
        $baiviet = BaiViet::findOrFail($id);
       
        $baiviet_lienquan = BaiViet::whereNotIn('id', [$id])
            ->get();
        return view('client.ctbaiviet', compact('baiviet', 'baiviet_lienquan')); // Trả về view chỉnh sửa
    }
    public function hdthicong(){
                    return view('client.hdthicong'); // Trả về view chỉnh sửa

    }
}
