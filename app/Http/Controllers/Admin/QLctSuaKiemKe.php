<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuKiemKe;
use App\Models\Kho;
use App\Models\PhieuKiemKe;
use App\Models\SanPham;
use Illuminate\Http\Request;

class QLctSuaKiemKe extends Controller
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
        $id = session('idPhieuKiemKe');
        $phieukiemke = PhieuKiemKe::find($id);
        $kho = Kho::where('id', $phieukiemke->idKho)->first();
        $sanp = ChiTietKho::where('idKho', $phieukiemke->idKho)->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        return view('admin.QLkho.suaphieukiemke',compact('kho', 'sps','phieukiemke'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idKho' => 'required',
            'idSanPham' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'TrangThai' => 'required',
        ]);
        
        // Lấy thông tin sản phẩm
        $sanPham = SanPham::find($data['idSanPham']);
        $spkho = ChiTietKho::where('idSanPham', $data['idSanPham'])
                ->where('idKho',$data['idKho'])->first();
        
        if (!$sanPham) {
            return back()->with('error', 'Sản phẩm không tồn tại');
        }
        if ($data['SoLuong'] > $spkho->SoLuong) {
            return back()->with('error', 'Số lượng sản phẩm không hợp lệ');
        }
        
        // Lấy danh sách chi tiết hiện tại từ session
        $chiTietList = session('sua_chi_tiet_kiemke', []);
        
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách chưa
        foreach ($chiTietList as &$chiTiet) {
            if ($chiTiet['idSanPham'] == $data['idSanPham'] && $chiTiet['TrangThai'] == $data['TrangThai']) {
                $chiTiet['SoLuong'] += $data['SoLuong'];

                // Kiểm tra tổng số lượng trong session
                $totalQuantity = array_reduce($chiTietList, function ($carry, $item) use ($data) {
                    return $item['idSanPham'] == $data['idSanPham'] ? $carry + $item['SoLuong'] : $carry;
                }, 0);

                if ($totalQuantity > $spkho->SoLuong) {
                    return back()->with('error', 'Tổng số lượng sản phẩm trong danh sách vượt quá số lượng trong kho');
                }

                session(['sua_chi_tiet_kiemke' => $chiTietList]);
                return redirect()->route('QLphieukiemke.edit',session('idPhieuKiemKe'))->with('success', 'Đã cập nhật số lượng sản phẩm trong danh sách');
            }
        }
        if (isset($sanPham->banggia->Gia)) {
            $data['DonGia'] = $sanPham->banggia->Gia;
        } else {
            $data['DonGia'] = 0; // Hoặc giá mặc định nếu không có giá
        }
        // Thêm chi tiết mới vào danh sách
        $chiTietList[] = [
            'id' => count($chiTietList) + 1,
            'idSanPham' => $data['idSanPham'],
            'SoLuong' => $data['SoLuong'],
            'TrangThai' => $data['TrangThai'],
            'tenSanPham' => $sanPham->TenGoi,
            'DonGia' => $data['DonGia'],
        ];
        // Kiểm tra tổng số lượng trong session
        $totalQuantity = array_reduce($chiTietList, function ($carry, $item) use ($data) {
            return $item['idSanPham'] == $data['idSanPham'] ? $carry + $item['SoLuong'] : $carry;
        }, 0);
        if ($totalQuantity > $spkho->SoLuong) {
            return back()->with('error', 'Tổng số lượng sản phẩm trong danh sách vượt quá số lượng trong kho');
        }
        
        // Lưu lại vào session
        session(['sua_chi_tiet_kiemke' => $chiTietList]);
        return redirect()->route('QLphieukiemke.edit',session('idPhieuKiemKe'))->with('success', 'Đã thêm sản phẩm vào danh sách');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietPhieuKiemKe $chiTietPhieuKiemKe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idKho = session('idKho');
        $phieukiemke = PhieuKiemKe::find(session('idPhieuKiemKe'));
        $chiTietList = session('sua_chi_tiet_kiemke', []);
        $sanpham = $chiTietList[$id];
        $key = $id;
        $kho = Kho::where('id', $idKho)->first();
        $sanp = ChiTietKho::where('idKho', $idKho)->pluck('idSanPham');
        $sps = SanPham::whereIn('id', $sanp)->get();
        return view('admin.QLkho.suaphieukiemke', compact('sanpham','kho', 'sps','key','phieukiemke'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idKho = session('idKho');
        $phieukiemke = PhieuKiemKe::find(session('idPhieuKiemKe'));
        $data = $request->validate([
            'idSanPham' => 'required',
            'SoLuong' => 'required|numeric|min:1',
            'TrangThai' => 'required',
        ]);
        $chiTietList = session('sua_chi_tiet_kiemke', []);
        $spkho = ChiTietKho::where('idSanPham', operator: $data['idSanPham'])
                ->where('idKho', $idKho)->first();
        $sanPham = SanPham::find($data['idSanPham']);
        if (isset($chiTietList[$id])){
            if ($chiTietList[$id]['idSanPham']==$data['idSanPham'] && $chiTietList[$id]['TrangThai']==$data['TrangThai']){
                $chiTietList[$id]['SoLuong'] = $data['SoLuong'];
            } else if ($chiTietList[$id]['idSanPham'] != $data['idSanPham'] && $chiTietList[$id]['TrangThai'] == $data['TrangThai']) {
                foreach ($chiTietList as &$chiTiet) {
                    if ( $chiTiet['TrangThai'] == $data['TrangThai']) {
                        unset($chiTietList[$id]);
                        $chiTiet['SoLuong'] += $data['SoLuong'];
                    }
                }
            } else if ($chiTietList[$id]['idSanPham'] == $data['idSanPham'] && $chiTietList[$id]['TrangThai'] != $data['TrangThai']) {
                foreach ($chiTietList as &$chiTiet) {
                    if ( $chiTiet['TrangThai'] == $data['TrangThai']) {
                        unset($chiTietList[$id]);
                        $chiTiet['SoLuong'] += $data['SoLuong'];
                    }
                }
            } else {
                if (isset($sanPham->banggia->Gia)) {
                    $data['DonGia'] = $sanPham->banggia->Gia;
                } else {
                    $data['DonGia'] = 0; // Hoặc giá mặc định nếu không có giá
                }
            $chiTietList[$id]['idSanPham'] = $data['idSanPham'];
            $chiTietList[$id]['tenSanPham'] = $sanPham->TenGoi;
            $chiTietList[$id]['DonGia'] = $data['DonGia']; // Đặt giá mặc định nếu không có giá
            $chiTietList[$id]['SoLuong'] = $data['SoLuong'];
            $chiTietList[$id]['TrangThai'] = $data['TrangThai'];
            }
            $totalQuantity = array_reduce($chiTietList, function ($carry, $item) use ($data) {
                return $item['idSanPham'] == $data['idSanPham'] ? $carry + $item['SoLuong'] : $carry;
            }, 0);
            if ($totalQuantity > $spkho->SoLuong) {
                return back()->with('error', 'Tổng số lượng sản phẩm trong danh sách vượt quá số lượng trong kho');
            }
            
        }
        session(['sua_chi_tiet_kiemke' => $chiTietList]);
        return redirect()->route('QLphieukiemke.edit',$phieukiemke->id)->with('success', 'Đã sửa sản phẩm mới thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chiTietList = session('sua_chi_tiet_kiemke', []);
        unset($chiTietList[$id]);
        session(['sua_chi_tiet_kiemke' => array_values($chiTietList)]);
        return redirect()->route('QLphieukiemke.edit',session('idPhieuKiemKe'))->with('success', 'Đã xóa sản phẩm khỏi danh sách');
    }
}
