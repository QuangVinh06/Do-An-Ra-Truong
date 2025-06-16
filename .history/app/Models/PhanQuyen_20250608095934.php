<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
   use HasFactory;
   public $timestamps = false;
  
   protected $table = 'phan_quyen'; 
   protected $primaryKey = 'id';
   protected $fillable=[
    'id',
    'idTaiKhoan',
    'idQuyen'];
    public function User()
    {
        return $this->belongsTo(User::class, 'idTaiKhoan');
    }
    public function quyen()
    {
        return $this->belongsTo(Quyen::class, 'idQuyen');
    }
}
