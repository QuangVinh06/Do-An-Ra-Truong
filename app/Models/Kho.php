<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kho extends Model
{
    use HasFactory;
    protected $fillable = ['TenKho','DiaChi'];
}
