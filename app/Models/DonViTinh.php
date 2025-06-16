<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonViTinh extends Model
{
    public $timestamps = false; // Tắt timestamps
    protected $primaryKey = 'id';
    protected $table = 'don_vi_tinh'; 
    protected $fillable= ['id', 'TenDonViTinh'];
}
