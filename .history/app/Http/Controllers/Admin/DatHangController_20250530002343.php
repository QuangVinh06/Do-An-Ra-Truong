<?php

namespace App\Http\Controllers\Admin;
use App\Models\ChiTietKho;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatHang as Cart;
use App\Models\SanPham;
use Carbon\Carbon;
use App\Models\ChiTietPhieuDatHang;
use App\Models\PhieuDatHang;
use App\Models\PhuongThucTT;
use App\Models\KhachHang;
use App\Models\KhuyenMai;
class DatHangController extends Controller
{
    public function add($id)
    {
           $userId = Auth::guard('web')->id();
    if (!$userId) {
        return redirect()->back()->with('error', 'Người dùng chưa đăng nhập.');
    }
        $cart = new Cart($userId);
        $product = SanPham::findOrFail($id);
        $quantity = request('quantity', 1); 
        $cart->add($product, $quantity);
      
        return redirect()->route('dathang.view')->with('success', 'Thêm sản phẩm thành công');
    }

    public function view()
    {
        $userId = Auth::guard('web')->id();
        if (!$userId) {
        return redirect()->back()->with('error', 'Người dùng chưa đăng nhập.');
    }

        $loaikhachhang = KhachHang::where('idTaiKhoan', $userId)->value('idLoaiKhachHang');
  
        $khuyenmai= KhuyenMai::where('idLoaiKhachHang', $loaikhachhang)
            ->where('TrangThai', 1)
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now())
            ->first();
        $GiamGia = $khuyenmai ? (float)$khuyenmai->GiamGia : 0;
        $TenKhuyenMai = $khuyenmai ? $khuyenmai->TenKhuyenMai : null; // Lấy TenKhuyenMai nếu có

        $cart = new Cart($userId);
    

        return view('client.dathang', compact('cart', 'GiamGia','TenKhuyenMai'));
    }

    public function deleteDat($id)
    {
        $userId = Auth::id() ?? session()->getId();
        $cart = new Cart($userId);
        $cart->deleteC($id);

        return redirect()->route('dathang.view')->with('warning', 'Xóa sản phẩm thành công');
    }

    public function updateDat($id)
    {
        $userId = Auth::id() ?? session()->getId();
        $cart = new Cart($userId);
        $quantity = request('quantity', 1);
        $cart->updateC($id, $quantity);

        return redirect()->route('dathang.view');
    }

    public function clear()
    {
        $userId = Auth::id() ?? session()->getId();
        $cart = new Cart($userId);
        $cart->clear();

        return redirect()->route('dathang.view')->with('warning', 'Xóa đặt hàng thành công');
    }
   
public function addOrder(Request $request)
{
    $userId = Auth::guard('web')->id();
    if (!$userId) {
        return redirect()->back()->with('error', 'Người dùng chưa đăng nhập.');
    }

    $cart = new Cart($userId);

    if (empty($cart->items)) {
        return redirect()->back()->with('error', 'Phiếu đặt hàng trống.');
    }

    $idPhuongThuc = $request->input('phuong_thuc', 1); // lấy id phương thức từ radio

    $request->validate([
        'phuong_thuc' => 'required|exists:phuong_thuc_thanh_toan,id',
        'ghi_chu' => 'nullable|string|max:255',
    
    ]);
    $total = 0; 
    $totalquantity = 0;
    $idTaiKhoan = Auth::guard('web')->id();
    $idKhachHang = KhachHang::where('idTaiKhoan', $idTaiKhoan)->value('id');
    $khachHang = KhachHang::where('idTaiKhoan', $idTaiKhoan)->first();
    if (empty($khachHang->DiaChi) || empty($khachHang->SoDienThoai)) {
        return redirect()->route('client.thongtinkhachhang.edit')->with('warning', 'Vui lòng cập nhật địa chỉ và số điện thoại trong thông tin tài khoản trước khi đặt hàng.');
    }
    foreach ($cart->items as $item) {
        $idSanPham = $item->id;
        $soLuongMua = $item->quantity;

        $soLuongTonKho = ChiTietKho::where('idSanPham', $idSanPham)->sum('SoLuong');

        if ($soLuongMua > $soLuongTonKho) {
            return redirect()->back()->with('warning', 'Sản phẩm  không đủ số lượng tồn kho. ');
        }

    }
     
    
    // Tạo phiếu đặt hàng
    foreach ($cart->items as $item) {
        $price = $item->price ; 
        $total += $item->quantity * $price;
        $totalquantity += $item->quantity;}
    $phieuDat = PhieuDatHang::create([
        'NgayLap' => Carbon::now(),
        'GhiChu' => $request->input('ghi_chu'),
        'TrangThai' => 0, // 0 = Chờ xác nhận
        'idKhachHang' => $idKhachHang,
        'idKhuyenMai' => null,
        'idPhuongThuc' => $idPhuongThuc,
        'TongTien' => $total,
        'TongSoLuong' => $totalquantity,
    ]);

foreach ($cart->items as $item) {
    $donGia = $item->price ?? 0; 
    $soLuong = $item->quantity ?? 0; 
    $thanhTien = $donGia * $soLuong; 

    ChiTietPhieuDatHang::create([
        'idPhieuDat' => $phieuDat->id, 
        'idSanPham' => $item->id,
        'SoLuong' => $soLuong,
        'DonGia' => $donGia,
        'ThanhTien' => $thanhTien,
    ]);
}
    $cart->clear();

    return redirect()->route('dathang.view')->with('success', 'Đặt hàng thành công!');
}
  // Lấy ID hợp đồng từ các phiếu đặt hàng đó
   

   public function lichsu(){
    $user = Auth::guard('web')->user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
    }
  
    // Tìm khách hàng từ user
    $khachHang = KhachHang::whereHas('user', function ($query) use ($user) {
        $query->where('id', $user->id);
    })->firstOrFail();

    // Lấy ID phiếu đặt hàng của khách hàng
    $phieuDatIds = PhieuDatHang::with(['phuongthuc', 'khuyenmai']) // thêm các quan hệ cần thiết
    ->where('idKhachHang', $khachHang->id)
    ->get();

return view('client.lichsudathang', compact('phieuDatIds'));
 }
 public function show2(string $id)
 {
    $user = Auth::guard('web')->user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
    }
  
    // Tìm khách hàng từ user
    $khachHang = KhachHang::whereHas('user', function ($query) use ($user) {
        $query->where('id', $user->id);
    })->firstOrFail();

    // Lấy ID phiếu đặt hàng của khách hàng
    $idPhieuDat = PhieuDatHang::with(['phuongthuc', 'khuyenmai']) // thêm các quan hệ cần thiết
    ->where('idKhachHang', $khachHang->id)
    ->get();

     $ctdat = ChiTietPhieuDatHang::where('idPhieuDat', $id)->get();
     return view('client.chitietlichsu', compact('ctdat'));
 }
 public function destroy2($id)
    {
        $phieuDat = PhieuDatHang::findOrFail($id);
        $phieuDat->delete();
        return redirect()->route('client.lichsudathang')->with('success', 'Xóa phiếu đặt hàng thành công.');
    }
}
