<?php

namespace App\Http\Controllers\BaoCao;

use App\Http\Controllers\Controller;
use App\Models\ChiTietKho;
use App\Models\ChiTietPhieuDatHang;
use App\Models\ChiTietPhieuKiemKe;
use App\Models\ChiTietPhieuNhap;
use App\Models\DonHang;
use App\Models\HopDong;
use App\Models\KhachHang;
use App\Models\Kho;
use App\Models\KhuyenMai;
use App\Models\LoaiKhachHang;
use App\Models\PhieuDatHang;
use App\Models\PhieuKiemKe;
use App\Models\SanPham;
use Barryvdh\DomPDF\Facade\Pdf;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaoCaoBanHang extends Controller
{
    public function download(Request $request){
        $query = DonHang::query();
        $tuNgay = $request->from_date;
        $denNgay = $request->to_date;
    if ($request->search) {
        $query->where('id', $request->search);
    }

    if ($request->from_date) {
        $query->whereDate('NgayLap', '>=', $request->from_date);
    }

    if ($request->to_date) {
        $query->whereDate('NgayLap', '<=', $request->to_date);
    }

    $dhs = $query->get();
    $doanhThuTheoNgay = $dhs->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->NgayLap)->format('Y-m-d');
    })->map(function ($group) {
        return $group->sum('TongTienThanhToan');
    });
    $pdf = Pdf::loadView('baocao.banhang', compact('dhs','tuNgay','denNgay','doanhThuTheoNgay'));
    return $pdf->download('bao-cao-doanh-so.pdf');
    }
    public function download1(Request $request){
        $query = KhachHang::query();
        $tuNgay = $request->from_date;
        $denNgay = $request->to_date;
        if ($request->search) {
            $query->where('id', $request->search);
        }
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        $khachhangs = $query->with('loaikhachhang','user')->get();
        $solungkhach = $khachhangs->groupBy(fn($item) => $item->idLoaiKhachHang)
            ->map(fn($group): array => ['SoLuong' => $group->count(), 'LoaiKhachHang' => $group->first()->loaikhachhang->TenLoaiKhachHang]);
        $pdf = Pdf::loadView('baocao.khachhang', compact('khachhangs','tuNgay','denNgay','solungkhach'));
        return $pdf->download('bao-cao-khach-hang.pdf');
    }
    public function download2($email)
    {
        $donHangs = DonHang::whereHas('hopDong.phieuDatHang', function ($query) use ($email) {
                $query->where('Email', $email);
            })
            ->whereDoesntHave('chiTietDoiTra')
            ->orderBy('NgayLap', 'desc')
            ->get();
        $chiTietTheoDonHang = []; // Mảng: [idDonHang => [chi tiết đơn hàng]]
            if ($donHangs->isEmpty()) {
                return response()->json(['message' => 'Không có đơn hàng cho email này.'], 404);
            }
        foreach ($donHangs as $donHang) {
            $phieuDat = optional(optional($donHang->hopDong)->phieuDatHang);
            if ($phieuDat && $phieuDat->id) {
                $chiTiet = ChiTietPhieuDatHang::where('idPhieuDat', $phieuDat->id)->get();

                foreach ($chiTiet as $ct) {
                    $chiTietTheoDonHang[$donHang->id][] = [
                        'SanPham' => $ct->sanPham->TenGoi ?? 'N/A',
                        'SoLuong' => $ct->SoLuong,
                        'DonGia' => $ct->sanPham->banggia->Gia ?? 0,
                        'ThanhTien' => $ct->SoLuong * ($ct->sanPham->banggia->Gia ?? 0)
                    ];

                }
            } else {
                $chiTietTheoDonHang[$donHang->id] = []; // Không có chi tiết
            }
        }

        //return view('BaoCao.donhang', compact('donHangs', 'email', 'chiTietTheoDonHang'));
        $pdf = Pdf::loadView('BaoCao.donhang', compact('donHangs', 'email', 'chiTietTheoDonHang'));
        return $pdf->download("donhang_{$email}.pdf");
    }
    public function download3(Request $request)
    {
        // Tổng số sản phẩm
        $tongSanPham = SanPham::count();
        
        $tuNgay = $request->from_date;
        $denNgay = $request->to_date;

        // === Doanh thu theo ngày ===
        $doanhThuQuery = DB::table('phieu_dat_hang');

        if ($request->filled('from_date')) {
            $doanhThuQuery->whereDate('NgayLap', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $doanhThuQuery->whereDate('NgayLap', '<=', $request->to_date);
        }

        if (!$request->filled('from_date') && !$request->filled('to_date')) {
            $doanhThuQuery->whereYear('NgayLap', now()->year)
                        ->whereMonth('NgayLap', now()->month);
        }

        $doanhThuThang = $doanhThuQuery->sum('TongTien');

        // === Sản phẩm bán chạy ===
        $query = DB::table('chi_tiet_phieu_dat_hang')
            ->join('phieu_dat_hang', 'chi_tiet_phieu_dat_hang.idPhieuDat', '=', 'phieu_dat_hang.id')
            ->join('san_phams', 'chi_tiet_phieu_dat_hang.idSanPham', '=', 'san_phams.id')
            ->join('loai_san_phams', 'san_phams.idLoaiSanPham', '=', 'loai_san_phams.id')
            ->join('maus', 'san_phams.idMau', '=', 'maus.id')
            ->join('don_vi_tinh', 'san_phams.idDonViTinh', '=', 'don_vi_tinh.id')
            ->select(
                'san_phams.id',
                'san_phams.TenGoi',
                'san_phams.MoTa',
                'san_phams.HinhAnh',
                'loai_san_phams.TenLoaiSanPham',
                'maus.TenMau',
                'don_vi_tinh.TenDonViTinh',
                DB::raw('SUM(chi_tiet_phieu_dat_hang.SoLuong) as tong_so_luong'),
                DB::raw('SUM(chi_tiet_phieu_dat_hang.ThanhTien) as tong_tien')
            );

        if ($request->filled('from_date')) {
            $query->whereDate('phieu_dat_hang.NgayLap', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('phieu_dat_hang.NgayLap', '<=', $request->to_date);
        }

        if ($request->filled('category_id')) {
            $query->where('san_phams.idLoaiSanPham', $request->category_id);
        }

        $query->groupBy(
            'san_phams.id',
            'san_phams.TenGoi',
            'san_phams.MoTa',
            'san_phams.HinhAnh',
            'loai_san_phams.TenLoaiSanPham',
            'maus.TenMau',
            'don_vi_tinh.TenDonViTinh'
        );

        $sanPhamBanChay = $query->orderByDesc('tong_tien')->limit(10)->get();

    
        // Truyền dữ liệu sang view
        // return view('baocao.sanpham', [
        //     'tongSanPham' => $tongSanPham,
        //     'doanhThuThang' => $doanhThuThang,
        //     'sanPhamBanChay' => $sanPhamBanChay,
        // ]);

        // Nếu muốn xuất PDF:
        $pdf = Pdf::loadView('baocao.sanpham', compact('tongSanPham', 'doanhThuThang', 'sanPhamBanChay','tuNgay', 'denNgay'));
        return $pdf->download('bao-cao-san-pham.pdf');
        // return $pdf->download('bao-cao-san-pham.pdf');
    }
    public function download4(Request $request)
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
            ->when($from, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_phieu_nhaps.idSanPham', 'phieu_nhap_khos.idKho');

        // Tính hàng xuất
        $xuat = DB::table('chi_tiet_xuat_khos')
            ->join('phieu_xuat_khos', 'phieu_xuat_khos.id', '=', 'chi_tiet_xuat_khos.id_phieu_xuat_kho')
            ->select('chi_tiet_xuat_khos.id_san_pham', 'chi_tiet_xuat_khos.id_kho', DB::raw('SUM(chi_tiet_xuat_khos.SoLuong) as tong_xuat'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('chi_tiet_xuat_khos.id_kho', $idKho))
            ->when($from, fn($q) => $q->whereDate('phieu_xuat_khos.NgayLap', '>=', $from))
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
            ->when($from, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('phieu_nhap_khos.NgayLap', '<=', $to))
            ->groupBy('chi_tiet_phieu_nhaps.idSanPham')
            ->pluck('tong_nhap', 'idSanPham');

        $dsXuatSanPham = DB::table('chi_tiet_xuat_khos')
            ->join('phieu_xuat_khos', 'phieu_xuat_khos.id', '=', 'chi_tiet_xuat_khos.id_phieu_xuat_kho')
            ->select('chi_tiet_xuat_khos.id_san_pham', DB::raw('SUM(chi_tiet_xuat_khos.SoLuong) as tong_xuat'))
            ->when($idKho && $idKho != 0, fn($q) => $q->where('chi_tiet_xuat_khos.id_kho', $idKho))
            ->when($from, fn($q) => $q->whereDate('phieu_xuat_khos.NgayLap', '>=', $from))
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

        // return view('baocao.kho', [
        //     'tongTon' => $tonkho,
        //     'tongHuHong' => $huHong,
        //     'tongHangLoi' => $hangLoi,
        //     'kho' => $kho,
        //     'sanPhamThongKe' => $sanPhamThongKe,
        //     'kiemKeChiTiet' => $kiemKeChiTiet,
        // ]);
        $pdf = Pdf::loadView('baocao.kho', [
            'tongTon' => $tonkho,
            'tongHuHong' => $huHong,
            'tongHangLoi' => $hangLoi,
            'kho' => $kho,
            'sanPhamThongKe' => $sanPhamThongKe,
            'kiemKeChiTiet' => $kiemKeChiTiet,]
        );
        return $pdf->download('bao-cao-kho.pdf');
    }
}

