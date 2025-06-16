<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhanHoiKhachHang;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PhanHoiController extends Controller
{public function store(Request $request, $idSanPham)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        PhanHoiKhachHang::create([
            'comment' => $request->comment,
            'idKhachHang' => Auth::user()->khachHang->id,
            'idSanPham' => $idSanPham,
            'ThoiGian' => Carbon::now(),
        ]);

        return back()->with('success', 'Phản hồi đã được gửi.');
    }

    public function destroy($id)
    {
        $phanHoi = PhanHoiKhachHang::findOrFail($id);

        if (Auth::user()->khachHang->id != $phanHoi->idKhachHang) {
            abort(403, 'Không có quyền xoá phản hồi này.');
        }

        $phanHoi->delete();

        return back()->with('success', 'Đã xoá phản hồi.');
    }
}
