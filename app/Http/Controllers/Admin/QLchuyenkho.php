<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuChuyenKho;
use App\Models\Kho;
use App\Models\PhieuChuyenKho;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QLchuyenkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search'); 
        $pcks = PhieuChuyenKho::with(['khoChuyen', 'khoNhan'])
                ->when($query, function ($q) use ($query) {
                $q->where('NgayLap', 'like', '%' . $query . '%');
            })->orderBy('id', 'desc')->get();
        session()->forget('chi_tiet_chuyen');
        session()->forget('sua_chi_tiet_chuyen');
        return view('admin.QLkho.QLchuyenkho', compact('pcks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $query = $request->query('idKhoChuyen');
        if ($query) {
            session()->put('idKhoChuyen', $query);
        } else {
            $query = session('idKhoChuyen'); // Lấy từ session nếu không có trong request
        }
        $khoChuyen = Kho::find($query);
        $khoChuyens = Kho::all();
        $khoNhans = Kho::where('id', '!=', $query)->get();
        $sanp = ChiTietKho::where('idKho', $query)->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        return view('admin.QLkho.themphieuchuyenkho', compact('khoChuyen','khoChuyens', 'khoNhans', 'sps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $data = $request->validate([
            'idKhoChuyen' => 'required',
            'idKhoNhan' => 'required',
            'NguoiChuyen' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);
        $storeData = [
            'idKhoChuyen' => $data['idKhoChuyen'],
            'idKhoNhan' => $data['idKhoNhan'],
            'NguoiChuyen' => $data['NguoiChuyen'],
            'GhiChu' => $data['GhiChu'],
            'NgayLap' => now(),
            'NguoiLap' => Auth::guard('admin')->user()->name
        ];
        // Tạo phiếu nhập kho
        $phieuchuyenkho = PhieuChuyenKho::create($storeData);
        
        // Lấy danh sách chi tiết từ session (nếu có)
        $chiTietList = session('chi_tiet_chuyen', []);
        
        // Thêm các chi tiết vào database
        foreach ($chiTietList as $chiTiet) {
            ChiTietPhieuChuyenKho::create([
                'idPhieuChuyenKho' => $phieuchuyenkho->id,
                'idSanPham' => $chiTiet['idSanPham'],
                'SoLuong' => $chiTiet['SoLuong'],
            ]);
            // Cập nhật số lượng trong bảng sản phẩm
            $sptukhochuyen = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])->where('idKho', $data['idKhoChuyen'])->first();
            $sptukhonhan = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])->where('idKho', $data['idKhoNhan'])->first();
            if ($sptukhochuyen) {
                $sptukhochuyen->SoLuong -= $chiTiet['SoLuong'];
                $sptukhochuyen->save();
            }
            if ($sptukhonhan) {
                $sptukhonhan->SoLuong += $chiTiet['SoLuong'];
                $sptukhonhan->save();
            }
            if (!$sptukhonhan) {
                ChiTietKho::create([
                    'idSanPham' => $chiTiet['idSanPham'],
                    'idKho' => $data['idKhoNhan'],
                    'SoLuong' => $chiTiet['SoLuong'],
                ]);
            }
        }
        
        // Xóa session sau khi đã lưu
        session()->forget('chi_tiet_chuyen');
        
        return redirect()->route('QLphieuchuyenkho.index')->with('success', 'Thêm phiếu nhập kho thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phieunhap=PhieuChuyenKho::find($id);
        $ct=ChiTietPhieuChuyenKho::where('idPhieuChuyenKho',$id)->get();
        return view('admin.QLkho.chitietphieuchuyenkho',compact('phieunhap','ct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phieuChuyenKho = PhieuChuyenKho::find($id);
        $khoChuyen = Kho::find($phieuChuyenKho->idKhoChuyen);
        $khoNhans = Kho::where('id', '!=', $phieuChuyenKho->idKhoChuyen)->get();
        $sanp = ChiTietKho::where('idKho', $phieuChuyenKho->idKhoChuyen)->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        $ct = ChiTietPhieuChuyenKho::where('idPhieuChuyenKho', $id)->get();
        $ts=session('sua_chi_tiet_chuyen',[]);
        if (count($ts) == 0) {
            $ctsp = [];
            foreach ($ct as $item) {
                $ctsp[] = [
                    'idSanPham' => $item->idSanPham,
                    'SoLuong' => $item->SoLuong,
                    'tenDonVi' => $item->sanPham->donvitinh->TenDonViTinh,
                    'tenSanPham' => $item->sanPham->TenGoi,
                ];
            }
            session(['sua_chi_tiet_chuyen' => $ctsp]);
        }
        
        session(['idPhieuChuyen' => $id]);
        return view('admin.QLkho.suaphieuchuyenkho', compact('phieuChuyenKho', 'khoChuyen', 'khoNhans', 'sps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'idKhoChuyen' => 'required',
            'idKhoNhan' => 'required',
            'NguoiChuyen' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);
        $phieuChuyenKho = PhieuChuyenKho::find($id);
        $phieuChuyenKho->update([
            'idKhoChuyen' => $data['idKhoChuyen'],
            'idKhoNhan' => $data['idKhoNhan'],
            'NguoiChuyen' => $data['NguoiChuyen'],
            'GhiChu' => $data['GhiChu'],
        ]);
        $chiTiet = ChiTietPhieuChuyenKho::where('idPhieuChuyenKho', $id)->get();
        foreach ($chiTiet as $item) {
            $sp = ChiTietKho::where('idSanPham', $item->idSanPham)->where('idKho', $phieuChuyenKho->idKhoChuyen)->first();
            if ($sp) {
                $sp->SoLuong += $item->SoLuong;
                $sp->save();
            }
            $sp = ChiTietKho::where('idSanPham', $item->idSanPham)->where('idKho', $phieuChuyenKho->idKhoNhan)->first();
            if ($sp) {
                $sp->SoLuong -= $item->SoLuong;
                $sp->save();
            }
        }
        ChiTietPhieuChuyenKho::where('idPhieuChuyenKho', $id)->delete();
        $chiTietList = session('sua_chi_tiet_chuyen', []);
        foreach ($chiTietList as $chiTiet) {
            ChiTietPhieuChuyenKho::create([
                'idPhieuChuyenKho' => $phieuChuyenKho->id,
                'idSanPham' => $chiTiet['idSanPham'],
                'SoLuong' => $chiTiet['SoLuong'],
            ]);
            // Cập nhật số lượng trong bảng sản phẩm
            $sptukhochuyen = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])->where('idKho', $data['idKhoChuyen'])->first();
            $sptukhonhan = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])->where('idKho', $data['idKhoNhan'])->first();
            if ($sptukhochuyen) {
                $sptukhochuyen->SoLuong -= $chiTiet['SoLuong'];
                $sptukhochuyen->save();
            }
            if ($sptukhonhan) {
                $sptukhonhan->SoLuong += $chiTiet['SoLuong'];
                $sptukhonhan->save();
            }
            if (!$sptukhonhan) {
                ChiTietKho::create([
                    'idSanPham' => $chiTiet['idSanPham'],
                    'idKho' => $data['idKhoNhan'],
                    'SoLuong' => $chiTiet['SoLuong'],
                ]);
            }
        }
        session()->forget('sua_chi_tiet_chuyen');
        return redirect()->route('QLphieuchuyenkho.index')->with('success', 'Cập nhật phiếu chuyển kho thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phieuChuyenKho = PhieuChuyenKho::find($id);
        $ct = ChiTietPhieuChuyenKho::where('idPhieuChuyenKho', $id)->get();
        foreach ($ct as $item) {
            $sp = ChiTietKho::where('idSanPham', $item->idSanPham)->where('idKho', $phieuChuyenKho->idKhoChuyen)->first();
            if ($sp) {
                $sp->SoLuong += $item->SoLuong;
                $sp->save();
            }
            $sp = ChiTietKho::where('idSanPham', $item->idSanPham)->where('idKho', $phieuChuyenKho->idKhoNhan)->first();
            if ($sp) {
                $sp->SoLuong -= $item->SoLuong;
                $sp->save();
            }
        }
        ChiTietPhieuChuyenKho::where('idPhieuChuyenKho', $id)->delete();
        PhieuChuyenKho::destroy($id);
        return redirect()->route('QLphieuchuyenkho.index')->with('success', 'Xóa phiếu chuyển kho thành công');

    }
    public function loadfrom()
    {
        $khoChuyens = Kho::all();
        $khoNhans = Kho::all();
        $sps = SanPham::all();
        return view('admin.QLkho.themphieuchuyenkho', compact('khoChuyens', 'khoNhans', 'sps'));
    }
}
