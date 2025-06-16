<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KhachHang;
use App\Models\PhieuDoiTra;
use App\Models\ChiTietPhieuDoiTra;
use Carbon\Carbon;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;
use App\Models\PhieuDatHang;
class QLdoitra extends Controller
{
    public function index(Request $request){
        $query = $request->input('search'); 

        $data = PhieuDoiTra::when($query, function ($q) use ($query) {
            $q->where('id', 'like', '%' . $query . '%');
    })->orderBy('id', 'desc')->get();
        return view('admin.QLdoitra.index',compact('data', 'query'));
    }
    public function show($id){
        $doitra = PhieuDoiTra::findOrFail($id);
        $ctdoitra = ChiTietPhieuDoiTra::where('idPhieuDoiTra', $id)->get();
        
        // Lấy đơn hàng đầu tiên từ chi tiết phiếu đổi trả
        $donHang = null;
        if (!$ctdoitra->isEmpty()) {
            $donHang = DonHang::find($ctdoitra[0]->idDonHang); // Hoặc bạn dùng first()
        }

        
        return view('admin.QLdoitra.chitietdoitra', compact('doitra', 'ctdoitra', 'donHang'));
                $ctdoitra = ChiTietPhieuDoiTra::where('idPhieuDoiTra', $id)->get();
        return view('admin.QLdoitra.chitietdoitra',compact('doitra','ctdoitra'));
    }
    public function doitra2()
{
    $user = Auth::guard('web')->user();

    if (!$user) {
        return redirect()->route('dangnhap')->with('error', 'Vui lòng đăng nhập để xem đổi trả.');
    }

    $khachHang = KhachHang::where('idTaiKhoan', $user->id)->first();

    if (!$khachHang) {
        return redirect()->route('trangchu')->with('error', 'Không tìm thấy thông tin khách hàng.');
    }

    $doiTras = PhieuDoiTra::where('idKhachHang', $khachHang->id)
                ->with('chiTietPhieuDoiTra') // nếu bạn có eager load
                ->orderBy('NgayLap', 'desc')
                ->get();

    return view('client.doitra2', compact('doiTras'));
}
    public function destroy($id){
        ChiTietPhieuDoiTra::where('idPhieuDoiTra', $id)->delete();
        PhieuDoiTra::destroy($id);
        return redirect()->route('QLdoitra.index')->with('success', 'Xóa phiếu đặt hàng thành công.');

    }
    public function create($id){
        $dh = DonHang::findOrFail($id);
        $PhieuDat = PhieuDatHang::where('TrangThai', 1)->get(); // Chỉ lấy phiếu đặt trạng thái 1
        return view('client.doitra',compact('dh','PhieuDat'));

    }
   
    public function store(Request $request)
    {
        $idTaiKhoan = Auth::id();
        $idKhachHang = KhachHang::where('idTaiKhoan', $idTaiKhoan)->value('id');
    
        $sanPhamIds = $request->input('san_pham_ids', []);
        $soLuongs = $request->input('so_luongs', []);
        $idDonHang = $request->input('idDonHang');
        $donHang = DonHang::find($idDonHang);

        // Kiểm tra đơn hàng tồn tại
        $donHangTonTai = DonHang::find($idDonHang);
        if (!$donHangTonTai) {
            return back()->with('warning', 'Đơn hàng không tồn tại.');
        }
        $phieuDoiTraDaCo = ChiTietPhieuDoiTra::where('idDonHang', $idDonHang)->exists();
        if ($phieuDoiTraDaCo) {
        return back()->with('warning', 'Đơn hàng này đã có phiếu đổi trả rồi, không thể tạo thêm.');
        }
        // Validate dữ liệu
        $request->validate([
            'mo_ta' => 'required|string|max:255',
            'ghi_chu' => 'nullable|string|max:255',
        ]);
    
        // Tạo phiếu đổi trả
        $phieuDoiTra = PhieuDoiTra::create([
            'NgayLap' => Carbon::now(),
            'GhiChu' => $request->input('ghi_chu'),
            'MoTa' => $request->input('mo_ta'),
            'idKhachHang' => $idKhachHang,
            'TrangThai'=>'Đang xử lý',
        ]);
    
        // Tạo chi tiết phiếu đổi trả
        foreach ($sanPhamIds as $id) {
            $soLuong = isset($soLuongs[$id]) ? intval($soLuongs[$id]) : 0;
            if ($soLuong > 0) {
                ChiTietPhieuDoiTra::create([
                    'idPhieuDoiTra' => $phieuDoiTra->id,
                    'idSanPham' => $id,
                    'SoLuong' => $soLuong,
                    'idDonHang' => $idDonHang,
                ]);
            }
        }
        $donHang->save();
        return redirect()->route('donhang.view') // hoặc route phù hợp của bạn
                         ->with('success', 'Thêm phiếu đổi trả thành công!');
    }
    
}
