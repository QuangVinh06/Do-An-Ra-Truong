<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuKiemKe;
use App\Models\Kho;
use App\Models\PhieuKiemKe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class QLchitietkho extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $querysp = $request->input('searchSP');
        $ks = Kho::all();
        if ($query == 0 ) {
            $sanpham = ChiTietKho::with('sanpham', 'kho')
                ->whereHas('sanpham', function ($query) use ($querysp) {
                    $query->where('TenGoi', 'like', '%' . $querysp . '%');
                })
                ->selectRaw('idSanPham, SUM(SoLuong) as TongSoLuong')
                ->where('SoLuong', '>', 0)
                ->groupBy('idSanPham')
                ->orderBy('idSanPham', 'desc')
                ->get();
            return view('admin.QLkho.QLchitietkho', compact('sanpham', 'ks'));
        }
        $sanpham = ChiTietKho::with('sanpham', 'kho')
                ->where('idKho', $query)
                ->whereHas('sanpham', function ($query) use ($querysp) {
                    $query->where('TenGoi', 'like', '%' . $querysp . '%');
             })
                ->selectRaw('idSanPham, SUM(SoLuong) as TongSoLuong')
                ->where('SoLuong', '>', 0)
                ->groupBy('idSanPham')
                ->orderBy('idSanPham', 'desc')
                ->get();
        return view('admin.QLkho.QLchitietkho', compact('sanpham', 'ks'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietKho $chiTietKho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChiTietKho $chiTietKho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChiTietKho $chiTietKho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChiTietKho $chiTietKho)
    {
        //
    }
    public function baoCao(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $idKho = $request->input('warehouse');

        // Danh sách kho
        $kho = DB::table('khos')->get();

        // Tính hàng nhập
        $nhap = DB::table('chi_tiet_phieu_nhaps')
            ->join('phieu_nhap_khos', 'phieu_nhap_khos.id', '=', 'chi_tiet_phieu_nhaps.idPhieuNhap')
            ->select('chi_tiet_phieu_nhaps.idSanPham', 'phieu_nhap_khos.idKho', DB::raw('SUM(chi_tiet_phieu_nhaps.SoLuong) as tong_nhap'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_nhap_khos.idKho', $idKho))
            ->when($to, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_phieu_nhaps.idSanPham', 'phieu_nhap_khos.idKho');
        
        // Tính hàng xuất
        $xuat = DB::table('chi_tiet_xuat_khos')
            ->join('phieu_xuat_khos', 'phieu_xuat_khos.id', '=', 'chi_tiet_xuat_khos.id_phieu_xuat_kho')
            ->select('chi_tiet_xuat_khos.id_san_pham', 'chi_tiet_xuat_khos.id_kho', DB::raw('SUM(chi_tiet_xuat_khos.SoLuong) as tong_xuat'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('chi_tiet_xuat_khos.id_kho', $idKho))
            ->when($to, fn($q) => $q->whereDate('phieu_xuat_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_xuat_khos.id_san_pham', 'chi_tiet_xuat_khos.id_kho');

        // Merge và tính tồn kho
        $dsNhap = $nhap->get();
        $dsXuat = $xuat->get();

        $tonkho = 0;
        foreach ($dsNhap as $n) {
            $slNhap = $n->tong_nhap;
            $slXuat = 0;
            foreach ($dsXuat as $x) {
                if ($x->id_san_pham == $n->idSanPham && $x->id_kho == $n->idKho) {
                    $slXuat = $x->tong_xuat;
                    break;
                }
            }
            $tonkho += max(0, $slNhap - $slXuat);
        }

        // Tính hàng hư hỏng (trạng thái 0)
        $huHong = DB::table('chi_tiet_phieu_kiem_kes')
            ->join('phieu_kiem_kes', 'phieu_kiem_kes.id', '=', 'chi_tiet_phieu_kiem_kes.idPhieuKiemKe')
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_kiem_kes.idKho', $idKho))
            ->when($from, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '<=', $to))
            ->where('chi_tiet_phieu_kiem_kes.TrangThai', 0)
            ->sum('chi_tiet_phieu_kiem_kes.SoLuong');

        // Tính hàng lỗi (trạng thái 3)
        $hangLoi = DB::table('chi_tiet_phieu_kiem_kes')
            ->join('phieu_kiem_kes', 'phieu_kiem_kes.id', '=', 'chi_tiet_phieu_kiem_kes.idPhieuKiemKe')
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_kiem_kes.idKho', $idKho))
            ->when($from, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '<=', $to))
            ->where('chi_tiet_phieu_kiem_kes.TrangThai', 3)
            ->sum('chi_tiet_phieu_kiem_kes.SoLuong');
        $dsNhapSanPham = DB::table('chi_tiet_phieu_nhaps')
            ->join('phieu_nhap_khos', 'phieu_nhap_khos.id', '=', 'chi_tiet_phieu_nhaps.idPhieuNhap')
            ->select('chi_tiet_phieu_nhaps.idSanPham', DB::raw('SUM(chi_tiet_phieu_nhaps.SoLuong) as tong_nhap'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_nhap_khos.idKho', $idKho))
            ->when($to, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_phieu_nhaps.idSanPham')
            ->pluck('tong_nhap', 'idSanPham');

        $dsXuatSanPham = DB::table('chi_tiet_xuat_khos')
            ->join('phieu_xuat_khos', 'phieu_xuat_khos.id', '=', 'chi_tiet_xuat_khos.id_phieu_xuat_kho')
            ->select('chi_tiet_xuat_khos.id_san_pham', DB::raw('SUM(chi_tiet_xuat_khos.SoLuong) as tong_xuat'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('chi_tiet_xuat_khos.id_kho', $idKho))
            ->when($to, fn($q) => $q->whereDate('phieu_xuat_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_xuat_khos.id_san_pham')
            ->pluck('tong_xuat', 'id_san_pham');

        // Lấy danh sách sản phẩm
        $sanPhamThongKe = DB::table('san_phams')
            ->leftJoin('don_vi_tinh', 'san_phams.idDonViTinh', '=', 'don_vi_tinh.id')
            ->leftJoin('maus', 'san_phams.idMau', '=', 'maus.id')
            ->leftJoin('loai_san_phams', 'san_phams.idLoaiSanPham', '=', 'loai_san_phams.id')
            ->select(
                'san_phams.id',
                'san_phams.TenGoi as ten_san_pham',
                'loai_san_phams.TenLoaiSanPham as loai',
                'maus.TenMau as mau',
                'don_vi_tinh.TenDonViTinh as don_vi'
            )
            ->get()
            ->map(function ($sp) use ($dsNhapSanPham, $dsXuatSanPham) {
                $nhap = $dsNhapSanPham[$sp->id] ?? 0;
                $xuat = $dsXuatSanPham[$sp->id] ?? 0;
                $sp->so_luong = max(0, $nhap - $xuat);
                return $sp;
            });
        $kiemKeChiTiet = DB::table('chi_tiet_phieu_kiem_kes')
            ->join('phieu_kiem_kes', 'phieu_kiem_kes.id', '=', 'chi_tiet_phieu_kiem_kes.idPhieuKiemKe')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_phieu_kiem_kes.idSanPham')
            ->leftJoin('loai_san_phams', 'san_phams.idLoaiSanPham', '=', 'loai_san_phams.id')
            ->leftJoin('maus', 'san_phams.idMau', '=', 'maus.id')
            ->leftJoin('don_vi_tinh', 'san_phams.idDonViTinh', '=', 'don_vi_tinh.id')
            ->select(
                'phieu_kiem_kes.NgayLap',
                'san_phams.TenGoi as ten_san_pham',
                'loai_san_phams.TenLoaiSanPham as loai',
                'maus.TenMau as mau',
                'don_vi_tinh.TenDonViTinh as don_vi',
                'chi_tiet_phieu_kiem_kes.SoLuong',
                'chi_tiet_phieu_kiem_kes.TrangThai'
            )
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_kiem_kes.idKho', $idKho))
             // Trạng thái khác 2 (đã xử lý)
            ->when($from, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '<=', $to))
            ->orderBy('phieu_kiem_kes.NgayLap', 'desc')
            ->get();
        $kiemKeXuLy = DB::table('chi_tiet_phieu_kiem_kes')
            ->join('phieu_kiem_kes', 'phieu_kiem_kes.id', '=', 'chi_tiet_phieu_kiem_kes.idPhieuKiemKe')
            ->when($idKho && $idKho != 0, fn($q) => $q->where('phieu_kiem_kes.idKho', $idKho))
            ->when($from, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_kiem_kes.NgayLap', '<=', $to))
            ->where('chi_tiet_phieu_kiem_kes.TrangThai', 2)
            ->sum('chi_tiet_phieu_kiem_kes.SoLuong');

        // Cộng thêm số lượng đã xử lý từ kiểm kê vào tổng tồn
        $tonkho += $kiemKeXuLy;

        return view('admin.QLkho.BaoCaoKho', [
            'tongTon' => $tonkho,
            'tongHuHong' => $huHong,
            'tongHangLoi' => $hangLoi,
            'kho' => $kho,
            'sanPhamThongKe' => $sanPhamThongKe,
            'kiemKeChiTiet' => $kiemKeChiTiet,
        ]);
    }
    
}
