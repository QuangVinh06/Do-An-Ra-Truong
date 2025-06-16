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
        Schema::create('phieu_chuyen_khos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idKhoChuyen');
            $table->unsignedInteger('idKhoNhan');
            $table->string('NguoiChuyen');
            $table->date('NgayLap');
            $table->string('GhiChu')->nullable();
            $table->timestamps();
            $table->foreign('idKhoChuyen')->references('id')->on('khos');
            $table->foreign('idKhoNhan')->references('id')->on('khos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_chuyen_khos');
    }
};
