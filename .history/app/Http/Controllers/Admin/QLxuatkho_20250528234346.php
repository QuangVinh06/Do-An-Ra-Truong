<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuDatHang;
use App\Models\ChiTietXuatKho;
use App\Models\DonHang;
use App\Models\HopDong;
use App\Models\Kho;
use App\Models\PhieuDatHang;
use App\Models\PhieuXuatKho;
use App\Models\SanPham;
use Illuminate\Http\Request;

class QLxuatkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hopdong = HopDong::where('TrangThaiCoc','Đã thanh toán đặt cọc')->pluck('id');
        $donhangs = DonHang::whereIn('idHopDong', $hopdong)->where('TrangThai','!=','Đang giao hàng')
        ->orwhere('TrangThai','Không yêu cầu cọc')->get();
        $query = $request->input('search'); 
        $psks = PhieuXuatKho::when($query, function ($q) use ($query) {
                $q->where('NgayLap', 'like', '%' . $query . '%');
            })->orderBy('id', 'desc')->get();
        session()->forget('dssanpham');
        session()->forget('kho');
        return view('admin.QLkho.QLxuatkho', compact('donhangs','psks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ctuat = $request->validate([
            'kho' => 'required|array', // Kho được chọn
            'kho.*' => 'exists:khos,id', // Đảm bảo ID kho tồn tại trong database
        ]);
        $ttxuat = $request->validate([
            'idDonHang' => 'required',
            'NguoiGiaoHang' => 'required|string',
            'GhiChu' => 'nullable|string',
        ]);
        // Lấy danh sách ID các kho được chọn từ request
        $khoIds = $request->input('kho');
        $dsSanPham = session('dssanpham',[]);
        $tongTien = 0;
        foreach ($dsSanPham as $index => $sp) {
            $sanpham = SanPham::where('id', $sp['idSanPham'])->first();
            $tongTien += $sanpham->banggia->Gia * $sp['SoLuong'];
        }
        $storeData = [
            'TongTien' => $tongTien,
            'NguoiNhanHang' => $ttxuat['NguoiGiaoHang'],
            'GhiChu' => $ttxuat['GhiChu'],
            'NgayLap' => now()
        ];
        // Tạo phiếu xuất kho
        $phieuXuat = PhieuXuatKho::create($storeData);
        foreach ($dsSanPham as $index => $sp) {
            $sanpham = SanPham::where('id', $sp['idSanPham'])->first();
            $ctkho = ChiTietKho::where('idKho', $khoIds[$index])->where('idSanPham', $sanpham->id)->first();
            if (isset($ctkho)) {
                if ($ctkho->SoLuong >= $sp['SoLuong']) {
                    $ctkho->SoLuong -= $sp['SoLuong'];
                    $ctkho->save();
                } else {
                    return redirect()->back()->with('error', 'Số lượng trong kho không đủ để xuất');
                }
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong kho');
            }
            ChiTietXuatKho::create([
                'id_phieu_xuat_kho' => $phieuXuat->id,
                'id_kho' => $khoIds[$index],
                'id_san_pham' => $sp['idSanPham'],
                'SoLuong' => $sp['SoLuong'],
            ]);
        }
        $donhang = DonHang::where('id', $ttxuat['idDonHang'])->first();
        $donhang->TrangThai = 'Đang giao hàng';
        $donhang->save();
        return redirect()->route('QLxuatkho.index')->with('success', 'Thêm phiếu xuất kho thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ct = ChiTietXuatKho::with('SanPham')->where('id_phieu_xuat_kho', $id)->get();
        $phieunhap = PhieuXuatKho::find($id);
        $tongtien = 0;
        foreach ($ct as $index => $ctsp) {
            $tongtien += $ctsp->SoLuong * $ctsp->sanPham->banggia->Gia;
        }
        return view('admin.QLkho.chitietphieuxuat', compact('ct', 'phieunhap', 'tongtien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donhang = DonHang::where('id', $id)->first();
        $hopdong = HopDong::where('id', $donhang->idHopDong)->first();
        $phieuDatHang = PhieuDatHang::where('id', $hopdong->idPhieuDat)->first();
        $chiTietDonHang = ChiTietPhieuDatHang::where('idPhieuDat',$phieuDatHang->id)->get();
        $kho = Kho::all();
        $sanpham = [];
        $dskho = [];
        foreach ($chiTietDonHang as $index => $ct) {
            $sanpham[] = [
                'idSanPham' => $ct->idSanPham,
                'TenSanPham' => $ct->sanPham->TenGoi,
                'SoLuong' => $ct->SoLuong,
                'TrangThai' => 'Không đủ hàng',
            ];
            foreach ($kho as $k) {
                $ctkho = ChiTietKho::where('idKho', $k->id)->where('idSanPham', $ct->idSanPham)->first();
                if (isset($ctkho)) {
                    if ($ctkho->SoLuong >= $ct->SoLuong) {
                        $dskho[] = [
                            'idKho' => $ctkho->idKho,
                            'TenKho' => $ctkho->Kho->TenKho,
                            'SoLuong' => $ctkho->SoLuong,
                            'idSanPham' => $ct->idSanPham,
                        ];
                        $sanpham[$index]['TrangThai'] = 'Đủ hàng';
                    } 
                } 
            }
        }
        session(['kho' => $dskho]);
        session(['dssanpham' => $sanpham]);
        return view('admin.QLkho.themphieuxuatkho', compact('donhang','chiTietDonHang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhieuXuatKho $phieuXuatKho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhieuXuatKho $phieuXuatKho)
    {
        //
    }
    public function xemdonhang($id) {
        // Tìm đơn hàng
        $donhang = DonHang::where('id', $id)->first();
        if (!$donhang) {
            return back()->with('error', 'Không tìm thấy đơn hàng!');
        }
    
        // Tìm hợp đồng liên quan
        $hopdong = HopDong::where('id', $donhang->idHopDong)->first();
        if (!$hopdong) {
            return back()->with('error', 'Không tìm thấy hợp đồng liên quan!');
        }
    
        // Tìm phiếu đặt hàng
        $phieuDatHang = PhieuDatHang::where('id', $hopdong->idPhieuDat)->first();
        if (!$phieuDatHang) {
            return back()->with('error', 'Không tìm thấy phiếu đặt hàng liên quan!');
        }
    
        // Tìm chi tiết đơn hàng
        $chiTietDonHang = ChiTietPhieuDatHang::where('idPhieuDat', $phieuDatHang->id)->get();
    
        return view('admin.QLkho.chitietdonhang', compact('donhang', 'chiTietDonHang', 'id'));
    }
    
}
