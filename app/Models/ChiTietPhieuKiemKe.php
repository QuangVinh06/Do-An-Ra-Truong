<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuKiemKe extends Model
{
    protected $table = 'chi_tiet_phieu_kiem_kes';
    protected $fillable = [
        'id',
        'idPhieuKiemKe',
        'idSanPham',
        'SoLuong',
        'TrangThai'
    ];

    public function phieuKiemKe()
    {
        return $this->belongsTo(PhieuKiemKe::class, 'idPhieuKiemKe', 'id');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham', 'id');
    }
}
