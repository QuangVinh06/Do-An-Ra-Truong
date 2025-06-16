<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class doimatkhau extends Controller
{
    public function index(Request $request, string $VaTro)
    {
        if ($VaTro === 'KhachHang') {
            $user = Auth::guard('web')->user();
        } else {
            $user = Auth::guard('admin')->user();
        }
        
        return view('admin.taikhoan.doimatkhau', compact('user'));
    }
   
  
    public function update(Request $request, string $id)
    {
       
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password'=> 'required|same:new_password'
        ]);
    
        $user = User::find($id);
        // if (!password_verify($request->old_password, $user->password)) {
        //     return redirect()->back()->with('error', 'Mật khẩu cũ không đúng');
        // }
        
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại');
        }
       
         if (!Hash::check($request->old_password, $user->password)) {
             return redirect()->back()->with('error', 'Mật khẩu cũ không đúng');
        }
        
        $newpassword = Hash::make($request->new_password);
       
        $user->update([
            'password' => $newpassword,
        ]);

        
       
        return view('admin.taikhoan.doimatkhau',compact('user'))->with('success', 'Đổi mật khẩu thành công');
    }

   
}
