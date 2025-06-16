<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phan_hoi_khach_hang',function(Blueprint $table){
            $table->increments('id');
           $table->string('comment');
            $table->unsignedInteger('idKhachHang');
            $table->unsignedInteger('idSanPham');
           $table->dateTime('ThoiGian');
            $table->timestamps();
            $table->foreign('idKhachHang')->references('id')->on('khach_hang');
            $table->foreign('idSanPham')->references('id')->on('san_phams');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phan_hoi_khach_hang');
    }
};
