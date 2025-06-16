<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuDatHang extends Model
{
    protected $table = 'chi_tiet_phieu_dat_hang'; // tên bảng
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idPhieuDat',
        'idSanPham',
        'SoLuong',
        'DonGia',
        'ThanhTien',
        'GhiChu',
    ];
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham', 'id');
    }
    public function phieuDatHang()
    {
        return $this->belongsTo(PhieuDatHang::class, 'idPhieuDat', 'id');
    }
}
