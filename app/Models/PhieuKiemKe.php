<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuKiemKe extends Model
{
    protected $table = 'phieu_kiem_kes';
    protected $fillable = [
        'id',
        'NgayLap',
        'idKho',
        'NguoiKiemKe',
        'GhiChu',
        'NguoiLap',
    ];

    public function chiTietPhieuKiemKe()
    {
        return $this->hasMany(ChiTietPhieuKiemKe::class, 'idPhieuKiemKe', 'id');
    }
    public function kho()
    {
        return $this->belongsTo(Kho::class, 'idKho', 'id');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham', 'id');
    }
}
