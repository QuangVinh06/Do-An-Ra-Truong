<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietXuatKho extends Model
{
    protected $table = 'chi_tiet_xuat_khos';
    protected $fillable = [
        'id_phieu_xuat_kho',
        'id_san_pham',
        'id_kho',
        'SoLuong',
    ];
    public function phieuXuatKho()
    {
        return $this->belongsTo(PhieuXuatKho::class, 'id_phieu_xuat_kho');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_san_pham');
    }
    public function kho()
    {
        return $this->belongsTo(Kho::class, 'id_kho');
    }
}
