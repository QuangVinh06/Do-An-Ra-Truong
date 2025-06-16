<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KhachHang extends Model
{
    use HasFactory;
    protected $table = 'khach_hang';
    protected $fillable = [
        'id','idTaiKhoan','idLoaiKhachHang','DiaChi','SoDienThoai',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'idTaiKhoan','id');
    }
    public function loaikhachhang()
    {
        return $this->belongsTo(LoaiKhachHang::class, 'idLoaiKhachHang','id');
    }
    public function donHangs()
{
    return $this->hasMany(DonHang::class, 'idKhachHang');
}
public function phieuDatHangs()
{
    return $this->hasMany(PhieuDatHang::class, 'idKhachHang','id');
}

}
