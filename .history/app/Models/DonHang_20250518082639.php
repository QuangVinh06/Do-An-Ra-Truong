<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';
    protected $fillable = [
        'id',
        'NgayLap',
        'TongTienThanhToan',
        'idHopDong',
        'TrangThai',
        'idKhachHang',
    ];

    public function hopDong()
    {
        return $this->belongsTo(HopDong::class, 'idHopDong');
    }

}
