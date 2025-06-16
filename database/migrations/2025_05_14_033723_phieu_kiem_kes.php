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
        Schema::create('phieu_kiem_kes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('NgayLap');
            $table->unsignedInteger('idKho');
            $table->string('NguoiKiemKe');
            $table->string('GhiChu')->nullable();
            $table->timestamps();
            $table->foreign('idKho')->references('id')->on('khos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_kiem_kes');

    }
};
