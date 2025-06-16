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
        Schema::create('ct_phieu_doi_tra', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idPhieuDoiTra');
            $table->unsignedInteger('idDonHang');
            $table->unsignedInteger('idSanPham');
            $table->unsignedInteger('SoLuong');
            $table->foreign('idPhieuDoiTra')->references('id')->on('phieu_doi_tra');
            $table->foreign('idDonHang')->references('id')->on('don_hang');
            $table->foreign('idSanPham')->references('id')->on('san_phams');
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
