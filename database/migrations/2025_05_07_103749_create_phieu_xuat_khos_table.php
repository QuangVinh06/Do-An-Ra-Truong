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
        Schema::create('phieu_xuat_khos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_kho')->index();
            $table->date('NgayLap');
            $table->string('NguoiNhanHang');
            $table->integer('TongTien')->default(0);
            $table->integer('Thue')->default(0);
            $table->integer('TongTienThanhToan')->default(0);
            $table->text('GhiChu')->nullable();
            $table->timestamps();
            $table->foreign('id_kho')->references('id')->on('khos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_xuat_khos');
    }
};
