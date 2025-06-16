<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\User;
use App\Models\PhieuDatHang;
use App\Models\LoaiKhachHang;
use Illuminate\Support\Facades\DB;
class QLTTKhachHang extends Controller
{
    
    public function edit()
{
    // Lấy thông tin người dùng hiện tại từ Auth
      $user = Auth::guard('web')->user();

    if (!$user) {
        // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông tin khách hàng.');
    }
      $khachHang = KhachHang::with('user', 'loaikhachhang')
        ->whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id); // Sử dụng ID thay vì tên tài khoản để đảm bảo chính xác
        })
        ->firstOrFail();
   $soDonHangHoanThanh = PhieuDatHang::where('Email', $khachHang->Email)
    ->whereHas('hopDong.donHang', function ($query) {
        $query->where('TrangThai', 'Đã thanh toán toàn bộ');
    })
    ->count();

  $loaiKhachHang = LoaiKhachHang::where('DieuKien', '<=', $soDonHangHoanThanh)
        ->orderBy('DieuKien', 'desc')
        ->first();

    if ($loaiKhachHang) {
        $khachHang->idLoaiKhachHang = $loaiKhachHang->id;
        $khachHang->save();
    }
  

    // Trả về view với thông tin khách hàng
    return view('client.thongtinkhachhang', compact('khachHang','soDonHangHoanThanh'));
}
public function update(Request $request)
{
    $user = Auth::guard('web')->user();
    if (!$user) {
        // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật thông tin.');
    }
    $khachHang = KhachHang::with('user')
    ->whereHas('user', function ($query) use ($user) {
        $query->where('id', $user->id);
    })
    ->firstOrFail();

    $user = $khachHang->user;

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'DiaChi' => 'nullable|string|max:255',
        'SoDienThoai' => 'nullable|string|max:20',
        'email' => 'required|email|max:255',
    ]);

    // Kiểm tra trùng tên tài khoản
    if (User::where('name', $data['name'])->where('id', '!=', $user->id)->exists()) {
        return redirect()->back()->with('error', 'Tên tài khoản đã tồn tại');
    }

    // Kiểm tra trùng email
    if (User::where('email', $data['email'])->where('id', '!=', $user->id)->exists()) {
        return redirect()->back()->with('error', 'Email đã tồn tại');
    }

    // Cập nhật tài khoản
    $user->update([
        'name' => $data['name'],
        'email' => $data['email'],
    ]);

    // Cập nhật khách hàng
    $khachHang->update([
        'DiaChi' => $data['DiaChi'],
        'SoDienThoai' => $data['SoDienThoai'],
    ]);

    return redirect()->route('client.thongtinkhachhang.edit')->with('success', 'Cập nhật thông tin thành công');
}

}
