<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    protected $table = 'hop_dong'; // tên bảng
    protected $primaryKey = 'id';
    public $timestamps = false;										
    protected $fillable = [
        'NgayLap',
        'ThoiGianKetThuc',
        'NgayGiaoHang',
        'NguoiGiaoHang',
        'GiaTriGocHopDong',
        'TienCoc',
        'Thue',
        'TongSoTienConLai',
        'TrangThaiCoc',
        'idPhieuDat',
        'FileHopDong'
    ];
 
    public function phieuDatHang()
    {
        return $this->belongsTo(PhieuDatHang::class, 'idPhieuDat', 'id');
    }
    public function donHang()
{
    return $this->hasOne(DonHang::class, 'idHopDong','id');
}
}
