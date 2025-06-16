<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LoaiSanPham extends Model
{
    use HasFactory;

    public $timestamps = false; // Tắt timestamps
    protected $primaryKey = 'id';
    protected $table = 'loai_san_phams'; 
    protected $fillable= ['id', 'TenLoaiSanPham'];

}
