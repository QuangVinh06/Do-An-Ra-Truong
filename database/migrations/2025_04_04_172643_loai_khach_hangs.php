<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {Schema::create('loai_khach_hangs',function(Blueprint $table){
        $table->increments('id');
        $table->string('TenLoaiKhachHang')->unique();
        $table->integer('DieuKien')->default(0);
        $table->timestamps();
    });}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
