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
            $q->whereHas('user', function ($q2) use ($query) {
                $q2->where('name', 'like', "%{$query}%");
            });
        })
        ->orderBy(User::select('name')
            ->whereColumn('users.id', 'phan_quyen.idTaiKhoan')
        , 'desc')
        ->get();

    // Chỉ lấy tài khoản không phải KhachHang
    $taikhoan = User::where('VaiTro', '!=', 'KhachHang')->get();
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
            'idQuyen' => 'required|string|exists:quyens,id',
        ],[
            'idTaiKhoan.required' => ' tài khoản không được để trống',
            'idQuyen.required' => ' quyền không được để trống',
            'idQuyen.exists' => ' quyền không tồn tại',
        
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
public function edit($id)
{   
    $pqs = PhanQuyen::with('user', 'quyen')->paginate(10);
    $phanquyen = PhanQuyen::findOrFail($id);
    $taikhoan = User::where('VaiTro', '!=', 'KhachHang')->get();
    $quyen = Quyen::all();
    return view('admin.taikhoan.phanquyen', compact('pqs', 'taikhoan', 'quyen', 'phanquyen'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $phanQuyen = PhanQuyen::findOrFail($id);

    $data = $request->validate([
        'idTaiKhoan' => 'required|string',
        'idQuyen' => 'required|string|exists:quyens,id',
    ],[
        'idTaiKhoan.required' => 'Tài khoản không được để trống',
        'idQuyen.required' => 'Quyền không được để trống',
        'idQuyen.exists' => 'Quyền không tồn tại',
    
    ]);

    // Kiểm tra trùng phân quyền (trừ bản ghi hiện tại)
    $exists = PhanQuyen::where('idTaiKhoan', $data['idTaiKhoan'])
        ->where('idQuyen', $data['idQuyen'])
        ->where('id', '!=', $phanQuyen->id)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Tài khoản đã có quyền này');
    }

    $phanQuyen->update($data);
    return redirect()->route('QLphanquyen.index')->with('success', 'Cập nhật phân quyền thành công');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
    // Tìm bản ghi dựa trên idTaiKhoan và idQuyen
    $phanQuyen = PhanQuyen::where('id', $id)
                          ->first();

    if (!$phanQuyen) {
        return redirect()->back()->with('error', 'Phân quyền không tồn tại.');
    }

    // Xóa bản ghi
   if ($phanQuyen->delete()) {
           return redirect()->route('QLphanquyen.index')->with('success', 'Xóa phân quyền thành công.');

    } else {
        // Xóa không thành công
        return redirect()->back()->with('error', 'Xóa phân quyền thất bại.');
    }   

}
}
