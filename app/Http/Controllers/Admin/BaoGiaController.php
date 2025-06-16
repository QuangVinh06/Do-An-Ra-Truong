<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
class BaoGiaController extends Controller
{
    public function index(){
        $data = SanPham::orderBy('MaSanPham', 'DESC')->paginate(20);
        return view('admin.BaoGia.index',compact('data'));

   }
}
