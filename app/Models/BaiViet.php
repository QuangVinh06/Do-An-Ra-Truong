<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $primaryKey = 'id';
   protected $table = 'bai_viets';
    protected $fillable = [
         'TieuDe',
         'HinhAnh',
         'NoiDung',
         'TomTat',

    ];
}
