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
        Schema::create('chi_tiet_phieu_kiem_kes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idPhieuKiemKe');
            $table->unsignedInteger('idSanPham');
            $table->integer('SoLuong');
            $table->string('TrangThai');
            $table->timestamps();
            $table->foreign('idPhieuKiemKe')->references('id')->on('phieu_kiem_kes');
            $table->foreign('idSanPham')->references('id')->on('san_phams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_kiem_kes');
    }
};
