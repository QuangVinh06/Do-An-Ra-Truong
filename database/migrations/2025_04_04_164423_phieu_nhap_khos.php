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
        Schema::create('phieu_nhap_khos',function(Blueprint $table){
       $table->increments('id');
       $table->date('NgayLap');
       $table->string('NguoiGiaoHang');
       $table->string('GhiChu');
       $table->unsignedInteger('idKho');
       $table->timestamps();
       $table->foreign('idKho')->references('id')->on('khos');
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
