<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PhuongThucThanhToan;
use Illuminate\Http\Request;

class PhuongThucThanhToanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PhuongThucThanhToan::query();

    if ($request->has('search')) {
        $query->where('TenPhuongThucThanhToan', 'like', '%' . $request->search . '%')
              ->orWhere('CachThuc', 'like', '%' . $request->search . '%');
    }
    $tt = $query->orderBy('id', 'desc')->get();
    return view('admin.phuongthucthanhtoan.index', compact('tt'));
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
            'TenPhuongThucThanhToan' => 'required|string|max:255',
            'CachThuc' => 'required|string'
        ],[
            'TenPhuongThucThanhToan.required' => 'Tên phương thức thanh toán không được để trống.',
            'CachThuc.required' => 'Cách thức thanh toán không được để trống.',
            'TenPhuongThucThanhToan.max' => 'Tên phương thức thanh toán không được vượt quá 255 ký tự.'
        ]);
        $storeData = [
            'TenPhuongThucThanhToan' => $data['TenPhuongThucThanhToan'],
            'CachThuc' => $data['CachThuc']
        ];
        PhuongThucThanhToan::create($storeData);
        return redirect()->route('phuongthucthanhtoan.index')->with('success', 'Thêm phương thức thanh toán thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $phuongthucthanhtoan = PhuongThucThanhToan::findOrFail($id);
        $tt = PhuongThucThanhToan::orderBy('id', 'desc')->get();
        return view('admin.phuongthucthanhtoan.index', compact('phuongthucthanhtoan', 'tt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $phuongthucthanhtoan = PhuongThucThanhToan::findOrFail($id);
        
        $data = $request->validate([
            'TenPhuongThucThanhToan' => 'required|string|max:255',
            'CachThuc' => 'required|string'
        ],[
            'TenPhuongThucThanhToan.required' => 'Tên phương thức thanh toán không được để trống.',
            'CachThuc.required' => 'Cách thức thanh toán không được để trống.',
            'TenPhuongThucThanhToan.max' => 'Tên phương thức thanh toán không được vượt quá 255 ký tự.'
        ]);
        $storeData = [
            'TenPhuongThucThanhToan' => $data['TenPhuongThucThanhToan'],
            'CachThuc' => $data['CachThuc']
        ];

        if ($phuongthucthanhtoan->update($storeData)) {
            return redirect()->route('phuongthucthanhtoan.index')
                ->with('success', 'Cập nhật phương thức thanh toán thành công.');
        }

        return redirect()->back()->with('error', 'Cập nhật phương thức thanh toán thất bại.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $phuongthucthanhtoan = PhuongThucThanhToan::findOrFail($id);
        $phuongthucthanhtoan->delete();
        
        return redirect()->route('phuongthucthanhtoan.index')
            ->with('success', 'Xóa phương thức thanh toán thành công.');
    }
}
