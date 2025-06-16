<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maus extends Model
{
    use HasFactory;
    protected $table = 'maus'; 
    protected $primaryKey = 'id'; // Khóa chính là MaMau
    public $incrementing = false; // Nếu MaMau không phải auto-increment
    protected $keyType = 'integer'; // Nếu MaMau là số nguyên
    protected $fillable = ['id', 'TenMau', 'HinhAnh'];
    public function sanphams()
    {
        return $this->hasMany(SanPham::class, 'id'); // Adjust 'color_id' to the actual foreign key
    }
}
