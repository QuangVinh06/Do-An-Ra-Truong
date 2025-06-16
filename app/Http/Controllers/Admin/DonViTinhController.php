<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonViTinh;
use Illuminate\Http\Request;
use App\Models\PhanQuyen;

class DonViTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search'); // Lấy từ khóa tìm kiếm
        $dvts = DonViTinh::when($query, function ($q) use ($query) {
            $q->where('TenDonViTinh', 'like', '%' . $query . '%');
        })->orderBy('id', 'desc')->get();

        return view('admin.donvitinh.index', compact('dvts'));
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
    public function store()
    {
        $data = request()->validate([
            'TenDonViTinh' => 'required|string',
        ],[
            'TenDonViTinh.required' => 'Tên đơn vị tính không được để trống.',
            'TenDonViTinh.max' => 'Tên đơn vị tính không được vượt quá 255 ký tự.'
        ]);

        if (DonViTinh::where('TenDonViTinh', $data['TenDonViTinh'])->exists()) {
            return redirect()->back()->with('error', 'Tên đơn vị tính đã tồn tại');
        }
        $storeData = [
            'TenDonViTinh' => $data['TenDonViTinh'],
        ];
        DonViTinh::create($storeData);
        return redirect()->route('donvitinh.index')->with('success', 'Thêm đơn vị tính thành cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(DonViTinh $donViTinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donvitinh = DonViTinh::find($id);
        $dvts = DonViTinh::all();
        return view('admin.donvitinh.index', compact('donvitinh','dvts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donvitinh = DonViTinh::findOrFail($id);
        $data = $request->validate([
            'TenDonViTinh' => 'required|string',
        ],[
            'TenDonViTinh.required' => 'Tên đơn vị tính không được để trống.',
            'TenDonViTinh.max' => 'Tên đơn vị tính không được vượt quá 255 ký tự.'
        ]);
        if (DonViTinh::where('TenDonViTinh', $data['TenDonViTinh'])->exists()) {
            return redirect()->back()->with('error', 'Tên đơn vị tính đã tồn tại');
        }
        $updateData = [
            'TenDonViTinh' => $data['TenDonViTinh'],
        ];
        $donvitinh->update($updateData);
        return redirect()->route('donvitinh.index')->with('success', 'Sửa đơn vị tính thành cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donvitinh = DonViTinh::findOrFail($id);
        $donvitinh->delete();
        return redirect()->route('donvitinh.index')->with('success', 'Xóa đơn vị tính thông.');
    }
}
