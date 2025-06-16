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
            $q->where('TenTaiKhoan', 'like', "%{$query}%");
            })->orderBy('id', 'desc')->get();
    
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
            'TenTaiKhoan' => 'required|string',
            'MatKhau' => 'required|string',
            'MatKhauNhapLai' => 'required|string',
            'Gmail' => 'required|string',
            'VaiTro' => 'required|string', 
        ]);

        if ($data['MatKhau'] !== $data['MatKhauNhapLai']) {
            return redirect()->back()->with('error', 'Mật khẩu không khớp');
        }

        if (User::where('name', $data['TenTaiKhoan'])->exists()) {
            return redirect()->back()->with('error', 'Tên tài khoản đã tồn tại');
        }

        if (User::where('email', $data['Gmail'])->exists()) {
            return redirect()->back()->with('error', 'Gmail đã tồn tại');
        }

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
        $taiKhoan = User::find($id);
        if (!$taiKhoan) {
            return redirect()->back()->withErrors(['error' => 'Tài khoản không tồn tại']);
        }
            return view('admin.TaiKhoan.doimatkhau', compact('taiKhoan'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenTaikhoan' => 'required|string',
            'Gmail' => 'required|string',
            'VaiTro' => 'required|string', 
        ]);

        if (User::where('name', $data['TenTaiKhoan'])->where('id', '<>', $id)->exists()) {
            return redirect()->back()->with('error', 'Tên tài khoản đã tồn tại');
        }

        if (User::where('email', $data['Gmail'])->where('id', '<>', $id)->exists()) {
            return redirect()->back()->with('error', 'Gmail đã tồn tại');
        }

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
