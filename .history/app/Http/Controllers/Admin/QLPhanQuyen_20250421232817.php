<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PhanQuyen;
use App\Models\Quyen;
use App\Models\User;
use Illuminate\Http\Request;

class QLPhanQuyen extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = $request->input('search');

$pqs = PhanQuyen::with('user', 'quyen')
    ->when($query, function ($q) use ($query) {
        $q->where('idTaiKhoan', 'like', "%{$query}%");
    })->orderBy('idTaiKhoan', 'desc')->get();

$taikhoan = User::all();
$quyen = Quyen::all();



return view('admin.taikhoan.phanquyen', compact('pqs', 'taikhoan', 'quyen'));
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
            'idTaiKhoan' => 'required|string',
            'idQuyen' => 'required|string',
        ]);

        if (PhanQuyen::where('idTaiKhoan', $data['idTaiKhoan'])->where('idQuyen', $data['idQuyen'])->exists()) {
            return redirect()->back()->with('error', 'Tài khoản đã có quyền này');
        }

        PhanQuyen::create($data);
        return redirect()->route('QLphanquyen.index')->with('success', 'Phân quyền thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhanQuyen $phanQuyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhanQuyen $phanQuyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhanQuyen $phanQuyen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idQuyen)
    {
       
    // Tìm bản ghi dựa trên idTaiKhoan và idQuyen
    $phanQuyen = PhanQuyen::where('idQuyen', $idQuyen)
                          ->first();

    if (!$phanQuyen) {
        return redirect()->back()->with('error', 'Phân quyền không tồn tại.');
    }

    // Xóa bản ghi
    $phanQuyen->delete();

    return redirect()->route('QLphanquyen.index')->with('success', 'Xóa phân quyền thành công.');
}
}
