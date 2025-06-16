<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $data = HoaDon::where(function($query) use ($search) {
                $query->where('MaGiaoDich', 'LIKE', '%'.$search.'%')->orWhere('idHopDong', 'LIKE', '%'.$search.'%');
                      
            })
            ->orderBy('id', 'DESC')
            ->paginate(5); 
        return view('admin.Qlhoadon.index',compact('data'));
    }
    public function destroy($id){
        $hoadon = HoaDon::find($id);

        if (!$hoadon) {
            return redirect()->back()->with('error', 'Không tìm thấy hoá đơn để xóa!');
        }
        // Thử xóa
        try {
           
            $hoadon->delete();
            return redirect()->route('Qlhoadon.index')->with('success', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
