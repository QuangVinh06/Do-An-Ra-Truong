<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietPhieuDatHang;

class PhieuDatHang extends Model
{
    protected $table = 'phieu_dat_hang'; // tên bảng
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'NgayLap',
        'GhiChu',
        'TrangThai',
        'TenKhachHang', 'SoDienThoai', 'Email', 'DiaChi', 'LoaiKhachHang',
        'idKhuyenMai',
        'idPhuongThuc',
        'TongTien',
        'TongSoLuong',
    ];
        public function khuyenMai()
    {
        return $this->belongsTo(KhuyenMai::class, 'idKhuyenMai', 'id');
    }
    public function phuongthuc()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'idPhuongThuc', 'id');
    }
    public function chiTietPhieuDat()
    {
        return $this->hasMany(ChiTietPhieuDatHang::class, 'idPhieuDat', 'id');
    }
    public function hopDong(){
        return $this->hasOne(HopDong::class, 'idPhieuDat', 'id');

    }
  
}
