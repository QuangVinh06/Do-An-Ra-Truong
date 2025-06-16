<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
  protected $table = 'san_phams';

  protected $primaryKey = 'id'; 
  public function loaiSanPham()
  {
      return $this->belongsTo(LoaiSanPham::class, 'idLoaiSanPham', 'id');
  }

  public function mau()
  {
      return $this->belongsTo(Maus::class, 'idMau', 'id');
  }

  public function donViTinh()
  {
      return $this->belongsTo(DonViTinh::class, 'idDonViTinh', 'id');
  }
  public function banggia()
  {
      return $this->hasOne(BangGia::class, 'idSanPham')->latestOfMany();
  }
  public function phanHoiKhachHangs()
{
    return $this->hasMany(PhanHoiKhachHang::class, 'idSanPham');
}
  protected $fillable = [
      'id',
      'TenGoi',
      'MoTa',
      'HinhAnh',
      'idLoaiSanPham',
      'idDonViTinh',
      'idMau',

  ];


  //  public $timestamps = false; // Nếu bảng không có created_at và updated_at
}
