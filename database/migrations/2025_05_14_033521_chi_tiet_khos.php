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
        Schema::create('chi_tiet_khos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idKho')->nullable();
            $table->unsignedInteger('idSanPham')->nullable();
            $table->unsignedInteger('SoLuong')->default(0);
            $table->timestamps();
            $table->foreign('idKho')->references('id')->on('khos');
            $table->foreign('idSanPham')->references('id')->on('san_phams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_khos');
    }
};
