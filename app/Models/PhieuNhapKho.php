<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhieuNhapKho extends Model
{
    use HasFactory;
    public function Kho(){
        return $this->belongsTo(Kho::class, 'idKho', 'id');
    }
    public function ChiTietNhapKho()
    {
        return $this->hasMany(ChiTietPhieuNhap::class, 'idPhieuNhapKho', 'id');
    }
    protected $fillable = [
        'NgayLap', 
        'NguoiGiaoHang', 
        'GhiChu',
        'idKho',
        'NguoiLap',
    ];
}
