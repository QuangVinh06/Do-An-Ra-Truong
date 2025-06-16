<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kho;
use App\Models\PhanQuyen;

class KhoController extends Controller
{
    
    public function index(Request $request)
    {  
        $query = $request->input('search'); // Lấy từ khóa tìm kiếm
        $ks = Kho::when($query, function ($q) use ($query) {
            $q->where('TenKho', 'like', '%' . $query . '%');
        })->orderBy('id', 'desc')->get();
       
        return view('admin.Kho.index', compact('ks'));
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
            'TenKho' => 'required|string',
            'DiaChi' => 'required|string',
        ],[
            'TenKho.required' => 'Tên kho không được để trống.',
            'DiaChi.required' => 'Địa chỉ kho không được để trống.'
           
        ]);
        if (Kho::where('TenKho', $data['TenKho'])->exists()) {
            return redirect()->back()->with('error', 'Tên kho đã tồn tại');
        }
        $storeData = [
            'TenKho' => $data['TenKho'],
            'DiaChi' => $data['DiaChi'],
        ];
        Kho::create($storeData);
        return redirect()->route('QLkho.index')->with('success', 'Thêm kho thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kho $kho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kho = Kho::find($id);
        $ks = Kho::all();
        return view('admin.Kho.index', compact('kho','ks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kho = Kho::find($id);
        $data = $request->validate([
            'TenKho' => 'required|string',
            'DiaChi' => 'required|string',
        ],[
            'TenKho.required' => 'Tên kho không được để trống.',
            'DiaChi.required' => 'Địa chỉ kho không được để trống.'
        ]);
        if (Kho::where('TenKho', $data['TenKho'])->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Tên kho đã tồn tại');
        }
        $updateData = [
            'TenKho' => $data['TenKho'],
            'DiaChi' => $data['DiaChi'],
        ];
        $kho->update($updateData);
        return redirect()->route('QLkho.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kho = Kho::find($id);
        $kho->delete();
        return redirect()->route('QLkho.index')->with('success', 'Xóa thành công');
    }
}
