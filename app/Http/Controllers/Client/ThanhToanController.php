<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuDatHang;
use App\Models\HopDong;
use Illuminate\Support\Facades\Auth;
use App\Models\KhachHang;
class ThanhToanController extends Controller
{
    public function index(Request $request){
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
        }
        $khachHang = KhachHang::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->firstOrFail();
    
      $hds = HopDong::with(['phieuDatHang', 'phieuDatHang.phuongthuc'])
            ->whereHas('phieuDatHang', function($query) {
                $query->where('Email', Auth::user()->email); // Hoặc điều kiện phù hợp
            })
           
            ->orderBy('id', 'desc')
            ->get();

        return view('client.thanhtoan', compact('hds'));
    }
    public function show($id){
        $hd = HopDong::findOrFail($id);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->where('idPhuongThuc',1)->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('client.chitietthanhtoansp', compact('hd','PhieuDat'));
    }
   
}