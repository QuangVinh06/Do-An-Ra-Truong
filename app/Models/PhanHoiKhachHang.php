<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanHoiKhachHang extends Model
{
    protected $table = 'phan_hoi_khach_hang';
    protected $fillable = [
        'comment',
        'idKhachHang',
        'idSanPham',
        'ThoiGian'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'idKhachHang');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham');
    }
}
