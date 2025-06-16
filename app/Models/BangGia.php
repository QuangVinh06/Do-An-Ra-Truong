<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BangGia extends Model
{
    use HasFactory;
    protected $table = 'bang_gia';
    protected $fillable = [
        'NgayLap',
        'GhiChu',
        'Gia',
        'idSanPham'
    ];
    public function sanpham() {
        return $this->belongsTo(SanPham::class,'idSanPham');
    }
}
