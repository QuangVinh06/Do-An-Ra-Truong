<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PhanQuyen;
class QLTaiKhoan extends Controller
{

public function index(Request $request)
{
    $query = $request->input('search');
    $tks = User::when($query, function ($q) use ($query) {
        $q->where(function ($subQ) use ($query) {
            $subQ->where('name', 'like', "%{$query}%")
                 ->orWhere('email', 'like', "%{$query}%");
        });
    })
    ->orderBy('id', 'desc')
    ->paginate(10);

    return view('admin.taikhoan.QLtaikhoan', compact('tks'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenTaiKhoan' => 'required|string|unique:users,name',
            'MatKhau' => 'required|string',
            'MatKhauNhapLai' => 'required|string|same:MatKhau',
            'Gmail' => 'required|email|unique:users,email',
            'VaiTro' => 'required|string|not_in:KhachHang', // Không cho phép vai trò là Khách Hàng
        ], [
            'TenTaiKhoan.required' => 'Tên tài khoản không được để trống',
            'MatKhau.required' => 'Mật khẩu không được để trống',
            'MatKhauNhapLai.required' => 'Mật khẩu nhập lại không được để trống',
            'Gmail.required' => 'Gmail không được để trống',
            'Gmail.email' => 'Gmail không hợp lệ',
            'Gmail.unique' => 'Gmail đã tồn tại',
            'VaiTro.required' => 'Vai trò không được để trống',
          

        ]);


    

        $storeData = [
            'name' => $data['TenTaiKhoan'],
            'password' => bcrypt($data['MatKhau']),
            'email' => $data['Gmail'],
            'VaiTro' => $data['VaiTro'],
        ];
        User::create($storeData);
        return redirect()->route('QLtaikhoan.index')->with('success', 'Tạo tài khoản thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $taiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taikhoan = User::find($id);
         $tks = User::orderBy('id', 'desc')->paginate(10);

        if (!$taikhoan) {
            return redirect()->back()->withErrors(['error' => 'Tài khoản không tồn tại']);
        }
            return view('admin.taikhoan.QLtaikhoan', compact('taikhoan', 'tks'));

    }

    /**
     * Update the specified resource in storage.
     */
   
       
public function update(Request $request, string $id)
{
    $data = $request->validate([
        'TenTaiKhoan' => 'required|string',
        'Gmail' => 'required|string|email|unique:users,email,' . $id,
        'VaiTro' => 'required|string', // Không cho phép vai trò là Khách Hàng
    ], [
        'TenTaiKhoan.required' => 'Tên tài khoản không được để trống',
        'Gmail.required' => 'Gmail không được để trống',
        'VaiTro.required' => 'Vai trò không được để trống',
        'Gmail.email' => 'Gmail không hợp lệ',
        'Gmail.unique' => 'Gmail đã tồn tại',
      
    ]);



    $updateData = [
        'name' => $data['TenTaiKhoan'],
        'email' => $data['Gmail'],
        'VaiTro' => $data['VaiTro'],
    ];
    User::where('id', $id)->update($updateData);
    return redirect()->route('QLtaikhoan.index')->with('success', 'Cập nhật tài khoản thành công');
}
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taikhoan = User::findOrFail($id);
        $taikhoan->delete();
        
        return redirect()->route('QLtaikhoan.index')
            ->with('success', 'Xóa tài khoản thành công.');
    }
}



