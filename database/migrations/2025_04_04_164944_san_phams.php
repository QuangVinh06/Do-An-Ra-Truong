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
        Schema::create('san_phams',function(Blueprint $table){
            $table->increments('id');
            $table->string('TenGoi',255);
            $table->string('MoTa');
            $table->string('HinhAnh',255);
            $table->unsignedInteger('idLoaiSanPham');
            $table->unsignedInteger('idMau');
            $table->unsignedInteger('idDonViTinh');
           
            $table->timestamps();
            $table->foreign('idLoaiSanPham')->references('id')->on('loai_san_phams');
            $table->foreign('idMau')->references('id')->on('maus');
            $table->foreign('idDonViTinh')->references('id')->on('don_vi_tinh');
         });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
