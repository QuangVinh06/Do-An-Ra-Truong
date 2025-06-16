<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuDoiTra extends Model
{
    protected $table = 'phieu_doi_tra';
    protected $fillable = [
        'id',
        'NgayLap',
        'MoTa',
        'GhiChu',
        'idKhachHang'
    ];
    public $timestamps = false;

    public function chiTietPhieuDoiTra()
    {
        return $this->hasOne(PhieuDoiTra::class, 'idPhieuDoiTra', 'id');
    }
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'idKhachHang', 'id');
    }
}
