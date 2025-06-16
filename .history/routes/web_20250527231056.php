<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BaoGiaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductCategory;
use App\Http\Controllers\Admin\DonViTinhController;
use App\Http\Controllers\Admin\KhoController;
use App\Http\Controllers\Admin\KhuyenMaiC;
use App\Http\Controllers\Admin\QlLoaiKhachHang;
use App\Http\Controllers\Admin\QLphieunhapkho;
use App\Http\Controllers\Admin\Themphieunhapkho;
use App\Http\Controllers\Client\CHomeController;
use App\Http\Controllers\Client\CProductController;
use App\Models\LoaiKhachHang;
use App\Http\Controllers\Admin\QLKhachHang;
use App\Http\Controllers\Admin\QLDangNhap;
use App\Http\Controllers\Admin\NguoidungController;
use App\Http\Controllers\Admin\QuyenController;
use App\Http\Controllers\Admin\PhuongThucThanhToanController;
use App\Http\Controllers\Admin\QLPhanQuyen;
use App\Http\Controllers\Admin\QLquyen;
use App\Http\Controllers\Admin\QLTaiKhoan;
use App\Http\Controllers\doimatkhau;
use App\Http\Controllers\Admin\BangGiaController;
use App\Http\Controllers\Admin\DatHangController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\HopDongController;
use App\Http\Controllers\Admin\QLTTKhachHang;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\Admin\QLchitietkho;
use App\Http\Controllers\Admin\QLChiTietSuaNhapKho;
use App\Http\Controllers\Admin\QLChiTietThemNhapKho;
use App\Http\Controllers\Admin\QLchuyenkho;
use App\Http\Controllers\Admin\QLctSuachuyenkho;
use App\Http\Controllers\Admin\QLctSuaKiemKe;
use App\Http\Controllers\Admin\QLctThemchuyenkho;
use App\Http\Controllers\Admin\QLctThemKiemKe;
use App\Http\Controllers\Admin\Qlphieudat;
use App\Http\Controllers\Admin\QLphieukiemke;
use App\Http\Controllers\Admin\QLxuatkho;
use App\Http\Controllers\Client\ThanhToanController;
use App\Http\Controllers\Admin\HoaDonController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\PhanHoiController;
use App\Http\Controllers\Admin\QLdoitra;
use App\Http\Controllers\Admin\QLbaiviet;
use App\Http\Controllers\Client\BaiVietC;
use App\Http\Controllers\Admin\DocumentController;
Route::group(['prefix' => 'admin', 'middleware'=>'check'], function(){

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/QLkhachhang', [QLKhachHang::class, 'index'])->name('QLthongtinkhachhang.index');
    Route::post('/qlphieudat/{id}/xacnhan', [Qlphieudat::class, 'xacNhan'])->name('qlphieudat.xacnhan');
    Route::post('/QLdonhang/thanhtoan/{id}', [DonHangController::class, 'xacNhanThanhToan'])->name('QLdonhang.thanhtoan');
    Route::get('/bao-cao-thong-ke-doanh-so',[DonHangController::class,'baocao'])->name('QLdonhang.baocao');
    Route::get('/bao-cao-thong-ke-khach-hang',[QLKhachHang::class,'baocao'])->name('QLKhachHang.baocao');
    Route::get('/bao-cao-thong-ke-san-pham',[ProductController::class,'baocao'])->name('QLsanpham.baocao');
    Route::get('/bao-cao-thong-ke-khach-hang/{id}/donhang', [QLKhachHang::class, 'xemDonHang'])->name('QLKhachHang.donhang');
    Route::get('/bao-cao-thong-ke-khach-hang/{id}/ctdonhang', [QLKhachHang::class, 'xemctDonHang'])->name('QLKhachHang.xemctdonhang');

    //  Route::get('/color', [ColorController::class, 'index'])->name('admin.color');
  Route::resource('color', ColorController::class);
  Route::resource('donvitinh', DonViTinhController::class);
  Route::resource('productcategory', ProductCategory::class);
  Route::resource('Baogia', BangGiaController::class);
  Route::resource('QLthongtinkhachhang', QLKhachHang::class);
  
  Route::resources([
    'QLchitietkho' => QLchitietkho::class,
    'QLphieunhapkho' => QLphieunhapkho::class,
    'QLchitietthemphieunhap' => QLChiTietThemNhapKho::class,
    'QLchitietsuaphieunhap' => QLChiTietSuaNhapKho::class,
    'QLphieukiemke' => QLphieukiemke::class,
    'QLctthemkiemke' => QLctThemKiemKe::class,
    'QLctsuakkiemke' => QLctSuaKiemKe::class,
    'QLphieuchuyenkho' => QLchuyenkho::class,
    'QLctthemchuyenkho' => QLctThemchuyenkho::class,
    'QLctsuachuyenkho' => QLctSuachuyenkho::class,
    'QLxuatkho'=> QLxuatkho::class,
  ]);
  Route::get('/baocao-thong-ke-kho', [QLchitietkho::class, 'baocao'])->name('QLchitietkho.baocao');
  Route::get('/loadfrom', [QLchuyenkho::class, 'loadfrom'])->name('loadform');
  Route::get('/xemdonhang/{id}', [QLxuatkho::class, 'xemdonhang'])->name('xemdonhang');
  Route::resource('QLkho', controller: KhoController::class);
  Route::resource('QLhopdong',HopDongController::class);
  Route::resource('MNproduct',ProductController::class);
  Route::resource('QLloaikhachhang',QlLoaiKhachHang::class);
  Route::resource('QLkhuyenmai',KhuyenMaiController::class);
  Route::resource('qlphieudat',Qlphieudat::class);
  Route::resource('QLdonhang',DonHangController::class);
  Route::resource('phuongthucthanhtoan',PhuongThucThanhToanController::class);
  Route::resource('Qlhoadon',HoaDonController::class);
  Route::resource('QLdoitra',QLdoitra::class);
  Route::resources([
        'QLtaikhoan' => QLTaiKhoan::class,
        'QLquyen' => QLquyen::class,
        'QLphanquyen' => QLPhanQuyen::class
    ]);
    route::resource('QLbaiviet',QLbaiviet::class);
     Route::get('/download/{id}', [HopDongController::class, 'download'])->name('document.download');

});



Route::group(['prefix' => ''], function () {
  Route::get('/',[CHomeController::class,'index'])->name('client.home');
  Route::get('/sanpham/{id}',[CProductController::class,'show'])->name('sanphamtheodanhmuc.show');
  Route::get('/sanpham',[CProductController::class,'index'])->name('sanpham.index');
  Route::get('/hopdong/download/{id}', [HopDongController::class, 'download'])->name('hopdong.download');

  Route::get('/san-pham/{id}', [CProductController::class, 'showProductDetail'])->name('sanpham.chitiet');
  Route::get('/khuyen-mai', [KhuyenMaiC::class, 'index'])->name('khuyenmai.index');
   //Route::get('/dangky', [Home::class,'dangky'])->name('home.dangky');
   Route::get('/khachhang/thongtin', [QLTTKhachHang::class, 'edit'])->name('client.thongtinkhachhang.edit');
   Route::put('user/khachhang', [QLTTKhachHang::class, 'update'])->name('thongtinkhachhang.update');
  Route::get('/donhang',[DonHangController::class,'view'])->name('donhang.view');
  Route::get('/baiviet',[BaiVietC::class,'index'])->name('baiviet.index');
  Route::get('/chitietbaiviet/{id}',[BaiVietC::class,'show'])->name('baiviet.show');
  Route::get('/huong-dan-thi-cong',[BaiVietC::class,'hdthicong'])->name('baiviet.hdthicong');
  Route::get('doitra/{id}',[QLdoitra::class,'create'])->name('QLdoitra.create');
  Route::post('themdoitra/',[QLdoitra::class,'store'])->name('doitra.store');

  Route::get('/gioi-thieu', function() {
    return view('client.GioiThieu');
  })->name('gioithieu');
  Route::get('/lien-he', function() {
    return view('client.LienHe');
  })->name('lienhe');
  Route::get('/thanhtoan',[ThanhToanController::class,'index'])->name('thanhtoan.index');
  Route::get('/xemthanhtoan/{id}',[ThanhToanController::class,'show'])->name('thanhtoan.show');
  Route::get('/ctdonhang/{id}',[DonHangController::class,'show2'])->name('QLdonhang.show2');
  Route::post('/vnpay_payment',[PaymentController::class,'vnpay_payment'])->name('vnpay_payment');
  Route::get('/lichsudathang',[DatHangController::class,'lichsu'])->name('client.lichsudathang');
  Route::get('/phieudat/{id}', [DatHangController::class, 'show2'])->name('qlphieudat.show2');
  Route::delete('/xoaphieudat/{id}', [DatHangController::class, 'destroy2'])->name('qlphieudat.destroy2');
  Route::post('/phan-hoi/{idSanPham}', [PhanHoiController::class, 'store'])->name('phanhoi.store');
  Route::delete('/phan-hoi/{id}', [PhanHoiController::class, 'destroy'])->name('phanhoi.destroy');

});
Route::get('/return-vnpay', [PaymentController::class, 'vnpayReturn'])->name('return-vnpay');
Route::group(['prefix' => 'dathang'], function (){
  Route::get('/',[DatHangController::class,'view'])->name('dathang.view');
  Route::get('/add/{product}',[DatHangController::class,'add'])->name('dathang.add');
  Route::get('/delete/{id}',[DatHangController::class,'deleteDat'])->name('dathang.delete');
  Route::get('/update/{id}',[DatHangController::class,'updateDat'])->name('dathang.update');
  Route::get('/clear',[DatHangController::class,'clear'])->name('dathang.clear');
  Route::post('/dat-hang',[DatHangController::class,'addOrder'])->name('dathang.addOrder');
});
    
   Route::get('/admin/error',[AdminController::class,'error'])->name('admin.error');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'check_login'])->name('admin.check_login');
    Route::get('/admin/register',[AdminController::class,'register'])->name('admin.register');
    Route::post('/admin/register',[AdminController::class,'check_register']);
    Route::get('/logout/{VaiTro}',[AdminController::class,'logout'] )->name('logout');
    Route::get('doimatkhau{VaiTro}/',[doimatkhau::class,'index'])->name('doimatkhau.index');
    Route::post('doimatkhau/{id}',[doimatkhau::class,'update'])->name('doimatkhau.update');