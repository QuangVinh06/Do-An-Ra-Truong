<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KhuyenMai extends Model
{
    use HasFactory;
    public function loaiKhachHang()
    {
        return $this->belongsTo(LoaiKhachHang::class, 'idLoaiKhachHang', 'id');
    }
    protected $fillable = [
        'id',
        'TenKhuyenMai',
        'GiamGia',
        'idLoaiKhachHang',
        'TrangThai',
        'NgayBatDau',
        'NgayKetThuc',
    ];
}
