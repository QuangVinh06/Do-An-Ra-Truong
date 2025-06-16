<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuKiemKe;
use App\Models\Kho;
use App\Models\PhieuKiemKe;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QLphieukiemke extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search'); 
        $pkks = PhieuKiemKe::with(['Kho'])
                ->when($query, function ($q) use ($query) {
                $q->where('NgayLap', 'like', '%' . $query . '%');
            })->orderBy('id', 'desc')->get();
        session()->forget('chi_tiet_kiemke');
        session()->forget('sua_chi_tiet_kiemke');
        session()->forget('idKho');
        session()->forget('idPhieuKiemKe');
        $ks = Kho::all();
        return view('admin.QLkho.QLkiemke', compact('pkks','ks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $query = $request->input('kho');
        $kho = Kho::where('id', $query)->first();
        $sanp = ChiTietKho::where('idKho', $query)
        ->where('SoLuong', '>', 0)
        ->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        session(['idKho' => $query]);
        return view('admin.qlkho.themphieukiemke', compact('kho', 'sps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idKho = session('idKho');
        $data = $request->validate([
            'NguoiKiemKe' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);
        $storeData = [
            'idKho' => $idKho,
            'NguoiKiemKe' => $data['NguoiKiemKe'],
            'GhiChu' => $data['GhiChu'],
            'NgayLap' => now(),
            'NguoiLap' => Auth::guard('admin')->user()->name
        ];
        // Tạo phiếu nhập kho
        $phieuKiemKe = PhieuKiemKe::create($storeData);
        
        // Lấy danh sách chi tiết từ session (nếu có)
        $chiTietList = session('chi_tiet_kiemke', []);
        
        // Thêm các chi tiết vào database
        foreach ($chiTietList as $chiTiet) {
            ChiTietPhieuKiemKe::create([
                'idPhieuKiemKe' => $phieuKiemKe->id,
                'idSanPham' => $chiTiet['idSanPham'],
                'SoLuong' => $chiTiet['SoLuong'],
                'TrangThai' => $chiTiet['TrangThai'],
            ]);
            // Cập nhật số lượng trong bảng sản phẩm
            $sanPham = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])->where('idKho', $idKho)->first();
            if ($sanPham) {
                $sp_mau = ChiTietKho::findOrFail($sanPham->id);
                if ($chiTiet['TrangThai'] == 2) {
                    $sp_mau->SoLuong += $chiTiet['SoLuong'];
                } else {
                    $sp_mau->SoLuong -= $chiTiet['SoLuong'];
                }
                $sp_mau->save();
            }
        }
        // Xóa session sau khi đã lưu
        session()->forget('chi_tiet_kiemke');
        return redirect()->route('QLphieukiemke.index')->with('success', 'Thêm phiếu kiểm kê thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ct = ChiTietPhieuKiemKe::with('sanPham')
            ->where('idPhieuKiemKe', $id)->get();
        $phieukiemke = PhieuKiemKe::find($id);
        return view('admin.QLkho.chitietphieukiemke', compact('ct', 'phieukiemke'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phieukiemke = PhieuKiemKe::find($id);
        $kho = Kho::where('id', $phieukiemke->idKho)->first();
        $sanp = ChiTietKho::where('idKho', $phieukiemke->idKho)
        ->where('SoLuong', '>', 0)
        ->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        $ct = ChiTietPhieuKiemKe::with('sanPham')
            ->where('idPhieuKiemKe', $id)->get();
        $ts = session('sua_chi_tiet_kiemke', []);
        if (count($ts)==0) {
            $chiTietTemp = [];
            foreach($ct as $chitiet) {
                if (isset($chitiet->sanPham->banggia->Gia)) {
                    $data = $chitiet->sanPham->banggia->Gia;
                } else {
                    $data = 0; // Hoặc giá mặc định nếu không có giá
                }
                $chiTietTemp[] = [
                    'idSanPham' => $chitiet->idSanPham,
                    'SoLuong' => $chitiet->SoLuong,
                    'TrangThai' => $chitiet->TrangThai,
                    'tenSanPham' => $chitiet->sanPham->TenGoi,
                    'DonGia' => $data,
                ];
            }
            session(['sua_chi_tiet_kiemke' => $chiTietTemp]);
        } 
        session(['idPhieuKiemKe' => $phieukiemke->id]);
        session(['idKho' => $phieukiemke->idKho]);
        return view('admin.QLkho.suaphieukiemke', compact('kho','sps','phieukiemke','ct'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $idKho = session('idKho');
        $data = $request->validate([
            'NguoiKiemKe' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);

        // Tìm phiếu nhập cần cập nhật
        $phieukiemke = PhieuKiemKe::findOrFail($id);
        
        // Cập nhật thông tin phiếu nhập
        $phieukiemke->update([
            'idKho' => $idKho,
            'NguoiKiemKe' => $data['NguoiKiemKe'],
            'GhiChu' => $data['GhiChu'],
            // Không cập nhật NgayLap để giữ nguyên ngày lập ban đầu
        ]);

        // Lấy danh sách chi tiết từ session (nếu có)
        $chiTietList = session('sua_chi_tiet_kiemke', []);
        
        if (!empty($chiTietList)) {
            // Hoàn trả số lượng của các chi tiết cũ
            $chiTietCu = ChiTietPhieuKiemKe::where('idPhieuKiemKe', $id)->get();
            foreach ($chiTietCu as $ctcu) {
                $sanPham = ChiTietKho::where('idSanPham', $ctcu->idSanPham)
                            ->where('idKho', $idKho)->first();
                if ($sanPham) {
                    if ($ctcu->TrangThai == 2) {
                        $sanPham->SoLuong -= $ctcu->SoLuong;
                    } else {
                        $sanPham->SoLuong += $ctcu->SoLuong;
                    }
                    $sanPham->save();
                }
            }
            
            // Xóa các chi tiết cũ
            ChiTietPhieuKiemKe::where('idPhieuKiemKe', $id)->delete();
            
            // Thêm các chi tiết mới
            foreach ($chiTietList as $chiTiet) {
                ChiTietPhieuKiemKe::create([
                    'idPhieuKiemKe' => $phieukiemke->id,
                    'idSanPham' => $chiTiet['idSanPham'],
                    'SoLuong' => $chiTiet['SoLuong'],
                    'TrangThai' => $chiTiet['TrangThai'],
                ]);
                
                // Cập nhật số lượng trong bảng sản phẩm
                $sanPham = ChiTietKho::where('idSanPham', $chiTiet['idSanPham'])
                            ->where('idKho', $idKho)->first();
                
                if ($sanPham) {
                    $sp_mau = ChiTietKho::findOrFail($sanPham->id);
                    if ($chiTiet['TrangThai']  == 2) {
                        $sp_mau->SoLuong += $chiTiet['SoLuong'];
                    } else {
                        $sp_mau->SoLuong -= $chiTiet['SoLuong'];
                    }
                    $sp_mau->save();
                }
            }
            
            // Xóa session sau khi đã lưu
            session()->forget('sua_chi_tiet_kiemke');
        }
        
        return redirect()->route('QLphieukiemke.index')->with('success', 'Cập nhật phiếu nhập kho thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phieuKiemKe = PhieuKiemKe::find($id);
        $chiTietKiemKe = ChiTietPhieuKiemKe::where('idPhieuKiemKe', $id)->get();
        foreach ($chiTietKiemKe as $chiTiet) {
            $sanPham = ChiTietKho::where('idSanPham', $chiTiet->idSanPham)
                        ->where('idKho', $phieuKiemKe->idKho)->first();
            if ($sanPham) {
                $sanPham->SoLuong += $chiTiet->SoLuong;
                $sanPham->save();
            }
            $chiTiet->delete();
        }
        $phieuKiemKe->delete();
        return redirect()->route('QLphieukiemke.index')->with('success', 'Xóa phiếu kiểm kê thành công');
    }

}
