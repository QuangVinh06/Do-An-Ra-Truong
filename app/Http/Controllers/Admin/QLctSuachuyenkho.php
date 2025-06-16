<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuChuyenKho;
use App\Models\Kho;
use App\Models\PhieuChuyenKho;
use App\Models\SanPham;
use Illuminate\Http\Request;

class QLctSuachuyenkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idSanPham' => 'required',
            'SoLuong' => 'required|numeric|min:1',
        ]);
        
        // Lấy thông tin sản phẩm
        $sanPham = SanPham::find($data['idSanPham']);
        $spkho = ChiTietKho::where('idSanPham', $data['idSanPham'])
                ->where('idKho', session('idKhoChuyen'))->first();
        
        if (!$sanPham) {
            return back()->with('error', 'Sản phẩm không tồn tại');
        }
        if ($data['SoLuong'] > $spkho->SoLuong) {
            return back()->with('error', 'Số lượng sản phẩm không hợp lệ');
        }
        
        // Lấy danh sách chi tiết hiện tại từ session
        $chiTietList = session('sua_chi_tiet_chuyen', []);
        
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách chưa
        foreach ($chiTietList as &$chiTiet) {
            if ($chiTiet['idSanPham'] == $data['idSanPham']) {
                $chiTiet['SoLuong'] += $data['SoLuong'];
                session(['sua_chi_tiet_chuyen' => $chiTietList]);
                return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'))->with('success', 'Đã cập nhật số lượng sản phẩm trong danh sách');
            }
        }
        // Thêm chi tiết mới vào danh sách
        $chiTietList[] = [
            'id' => count($chiTietList) + 1,
            'idSanPham' => $data['idSanPham'],
            'SoLuong' => $data['SoLuong'],
            'tenSanPham' => $sanPham->TenGoi,
            'tenDonVi' => $sanPham->donvitinh->TenDonViTinh,
        ];
        
        // Lưu lại vào session
        session(['sua_chi_tiet_chuyen' => $chiTietList]);
        return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'))->with('success', 'Đã thêm sản phẩm vào danh sách');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietPhieuChuyenKho $chiTietPhieuChuyenKho)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chiTietList = session('sua_chi_tiet_chuyen', []);
        foreach ($chiTietList as $key => $chiTiet) {
            if ($chiTiet['idSanPham'] == $id) {
                $sanpham = $chiTiet;
                $phieuChuyenKho = PhieuChuyenKho::find(session('idPhieuChuyen'));
                $khoChuyen = Kho::find($phieuChuyenKho->idKhoChuyen);
                $khoNhans = Kho::where('id', '!=', $khoChuyen)->get();
                $sanp = ChiTietKho::where('idKho', $khoChuyen->id)->pluck('idSanPham');
                $sps = SanPham::whereIn('id', $sanp)->get();
                return view('admin.QLkho.suaphieuchuyenkho', compact('sanpham','key','khoChuyen', 'phieuChuyenKho', 'khoNhans', 'sps'));
            }
        }
        return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'))->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idPhieuChuyen = session('idPhieuChuyen');
        $phieuChuyenKho = PhieuChuyenKho::find($idPhieuChuyen);
        $khoChuyen = Kho::find($phieuChuyenKho->idKhoChuyen);
        $idKho = $khoChuyen->id;
        $data = $request->validate([
            'SoLuong' => 'required|numeric|min:1',
            'idSanPham' => 'required',
        ]);
        $spkho = ChiTietKho::where('idSanPham', operator: $data['idSanPham'])
                ->where('idKho', $idKho)->first();
        $sanPham = SanPham::find($data['idSanPham']);
        $chiTietList = session('sua_chi_tiet_chuyen', []);
        if (isset($chiTietList[$id])) {
            if ($chiTietList[$id]['idSanPham'] != $data['idSanPham']) {
                foreach ($chiTietList as &$chiTiet) {
                    if ($chiTiet['idSanPham'] == $data['idSanPham']) {
                        unset($chiTietList[$id]);
                        $chiTiet['SoLuong'] += $data['SoLuong'];
                        $totalQuantity = array_reduce($chiTietList, function ($carry, $item) use ($data) {
                            return $item['idSanPham'] == $data['idSanPham'] ? $carry + $item['SoLuong'] : $carry;
                        }, 0);
        
                        if ($totalQuantity > $spkho->SoLuong) {
                            return back()->with('error', 'Tổng số lượng sản phẩm trong danh sách vượt quá số lượng trong kho');
                        }
                        session(['sua_chi_tiet_chuyen' => $chiTietList]);
                        return redirect()->route('QLphieuchuyenkho.edit', $idPhieuChuyen)->with('success', 'Đã cộng dồn số lượng sản phẩm trong danh sách');
                    }
                }
            }
            $chiTietList[$id] = [
            'idSanPham' => $data['idSanPham'],
            'tenSanPham'=> $sanPham->TenGoi,
            'tenDonVi' => $sanPham->donvitinh->TenDonViTinh,
            'SoLuong' => $data['SoLuong'],
            ];
            $totalQuantity = array_reduce($chiTietList, function ($carry, $item) use ($data) {
                return $item['idSanPham'] == $data['idSanPham'] ? $carry + $item['SoLuong'] : $carry;
            }, 0);

            if ($totalQuantity > $spkho->SoLuong) {
                return back()->with('error', 'Tổng số lượng sản phẩm trong danh sách vượt quá số lượng trong kho');
            }
            session(['sua_chi_tiet_chuyen' => $chiTietList]);
            return redirect()->route('QLphieuchuyenkho.edit', $idPhieuChuyen)->with('success', 'Đã cập nhật sản phẩm');
        }
        return redirect()->route('QLphieuchuyenkho.edit', $idPhieuChuyen)->with('error', 'Không tìm thấy sản phẩm trong danh sách');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chiTietList = session('sua_chi_tiet_chuyen', []);
        foreach ($chiTietList as $key => $chiTiet) {
            if ($chiTiet['idSanPham'] == $id) {
                unset($chiTietList[$key]);
                session(['sua_chi_tiet_chuyen' => $chiTietList]);
                return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'))->with('success', 'Đã xóa sản phẩm khỏi danh sách');
            }
        }
        return redirect()->route('QLphieuchuyenkho.edit', session('idPhieuChuyen'))->with('error', 'Không tìm thấy sản phẩm trong danh sách'); 
    }
}
