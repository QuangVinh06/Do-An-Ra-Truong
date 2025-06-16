<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChiTietPhieuNhap extends Model
{
    use HasFactory;
    public function PhieuNhapKho()
    {
        return $this->belongsTo(PhieuNhapKho::class, 'idPhieuNhapKho', 'id');
    }
    
    public function SanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham', 'id');
    }
    protected $fillable = [
        'idPhieuNhap',
        'idSanPham', 
        'SoLuong'
    ];
}
