<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $fillable = [
        'SoTienThanhToan',
        'NgayLap',
        'LoaiThanhToan',
        'idHopDong',
        'PhuongThuc',
        'MaGiaoDich'
    ];
    protected $table = 'hoa_don'; 

}
