<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKho extends Model
{
    protected $table = 'chi_tiet_khos';
    protected $fillable = [
        'idKho',
        'idSanPham',
        'SoLuong',
    ];

    public function kho()
    {
        return $this->belongsTo(Kho::class, 'idKho');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham');  
    }
}
