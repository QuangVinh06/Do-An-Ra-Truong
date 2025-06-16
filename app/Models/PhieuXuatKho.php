<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuXuatKho extends Model
{
    protected $table = 'phieu_xuat_khos';
    protected $fillable = [
        'NgayLap',
        'NguoiNhanHang',
        'TongTien',
        'GhiChu',
        'NguoiLap',
    ];

    public function chiTietXuatKhos()
    {
        return $this->hasMany(ChiTietXuatKho::class, 'id_phieu_xuat_kho');
    }

}
