<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuChuyenKho extends Model
{
    protected $table = 'chi_tiet_phieu_chuyen_khos';
    protected $fillable = [
        'idPhieuChuyenKho',
        'idSanPham',
        'SoLuong',
    ];

    public function phieuChuyenKho()
    {
        return $this->belongsTo(PhieuChuyenKho::class, 'idPhieuChuyenKho');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham');
    }
}
