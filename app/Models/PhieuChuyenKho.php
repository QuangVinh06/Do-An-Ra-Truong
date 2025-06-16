<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuChuyenKho extends Model
{
    protected $table = 'phieu_chuyen_khos';
    protected $fillable = [
        'idKhoChuyen',
        'idKhoNhan',
        'NguoiChuyen',
        'NgayLap',
        'GhiChu',
        'NguoiLap',
    ];
    public function khoChuyen()
    {
        return $this->belongsTo(Kho::class, 'idKhoChuyen');
    }
    public function khoNhan()
    {
        return $this->belongsTo(Kho::class, 'idKhoNhan');
    }
    public function chiTietPhieuChuyenKhos()
    {
        return $this->hasMany(ChiTietPhieuChuyenKho::class, 'idPhieuChuyenKho');
    }
}
