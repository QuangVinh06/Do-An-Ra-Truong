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
        Schema::create('chi_tiet_phieu_nhaps',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('SoLuong')->default(0);
            $table->unsignedInteger('idPhieuNhap');
            $table->unsignedInteger('idSanPham');
            $table->foreign('idPhieuNhap')->references('id')->on('phieu_nhap_khos');
            $table->foreign('idSanPham')->references('id')->on('san_phams');
            $table->timestamps();
         });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_nhaps');
    }
};
