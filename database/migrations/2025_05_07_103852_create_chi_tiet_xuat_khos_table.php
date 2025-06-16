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
        Schema::create('chi_tiet_xuat_khos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_phieu_xuat_kho')->index();
            $table->unsignedInteger('id_san_pham')->index();
            $table->integer('SoLuong')->default(0);
            $table->timestamps();
            $table->foreign('id_phieu_xuat_kho')->references('id')->on('phieu_xuat_khos');
            $table->foreign('id_san_pham')->references('id')->on('san_phams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_xuat_khos');
    }
};
