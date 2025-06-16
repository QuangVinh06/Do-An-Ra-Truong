<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PhanQuyen;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(){
    
        return view('admin.dashboard');
   }
   public function login(){
    return view('admin.login');
}
public function check_login(){
    // Validate dữ liệu đầu vào
    request()->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string',
    ]);

    // Lấy dữ liệu email và password từ request
    $data = request()->only('email', 'password');
    
    // Kiểm tra người dùng có tồn tại trong DB không
    $user = User::where('email', $data['email'])->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại']);
    }

    // Kiểm tra mật khẩu
    if (!Hash::check($data['password'], $user->password)) {
        return back()->withErrors(['password' => 'Sai mật khẩu']);
    }
     $VaiTro = $user->VaiTro;
        if( $VaiTro==='KhachHang'){
            Auth::guard('web')->login($user);
        return redirect()->route('client.home')->with('success', 'Đăng nhập thành công!');
        }
        else{
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công!');
        }
      
    
 
  
}

public function logout(Request $request, string $VaiTro){

    if ($VaiTro === 'KhachHang') {
        $user = Auth::guard('web')->user();
        if ($user) {
            Auth::guard('web')->logout();
            session()->regenerateToken();

            return redirect()->route('client.home')->with('success', 'Đăng xuất thành công!');
        }
      
    } else{
          // Logout admin
          $user = Auth::guard('admin')->user();
          if ($user) {
              Auth::guard('admin')->logout();
              session()->regenerateToken();
  
              return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!');
          }
       
    }
}

//admin_logout
//user_logout

  
    
    // Chuyển hướng đến dashboard
  


 public function register(){
  
    return view('admin.register');
   }
    public function check_register(){

        request()-> validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',// validation rules dinh dang @gmail,.. , khong trung voi email trong bang users
            'password'=> 'required',
            'confirm_password'=> 'required|same:password'
        ]);
        $data = request()->only('email','name');
        $data['password'] = bcrypt(request('password'));
        $data['VaiTro']="KhachHang";
        $taikhoan=User::Create($data);
        $storeData2 =[
            'idTaiKhoan' => $taikhoan->id,
            'idLoaiKhachHang' => 1, // hoặc để mặc định là khách lẻ
            'DiaChi' => '',
            'SoDienThoai' => '',
        ];
        $khachhang=KhachHang::create($storeData2);
        return redirect()-> route('admin.login');

 }


}





