<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuDoiTra extends Model
{
    protected $table = 'ct_phieu_doi_tra';
    protected $fillable = [
        'id',
        'idPhieuDoiTra',
        'idDonHang',
        'idSanPham',
        'SoLuong',
        
    ];
    public $timestamps = false;

    public function phieuDoiTra()
    {
        return $this->belongsTo(PhieuDoiTra::class, 'idPhieuDoiTra', 'id');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'idSanPham', 'id');
    }
    public function donHang()
{
    return $this->belongsTo(DonHang::class, 'idDonHang','id'); // hoặc tên cột đúng
}
}
