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
        Schema::create('chi_tiet_phieu_dat_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idPhieuDat');
            $table->unsignedInteger('idSanPham');
            $table->unsignedInteger('SoLuong');
            $table->unsignedInteger('DonGia');
            $table->unsignedInteger('ThanhTien');
            $table->timestamps();
            $table->foreign('idPhieuDat')->references('id')->on('phieu_dat_hang')->onDelete('cascade');
            $table->foreign('idSanPham')->references('id')->on('san_phams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
