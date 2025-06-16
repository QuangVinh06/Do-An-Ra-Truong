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
        Schema::create('phieu_dat_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('NgayLap');
            $table->string('GhiChu');
            $table->unsignedInteger('idKhachHang');
            $table->unsignedInteger('TrangThai');
            $table->unsignedInteger('idPhuongThuc');
            $table->unsignedInteger('TongTien');
            $table->unsignedInteger('TongSoLuong');
            $table->foreign('idKhachHang')->references('id')->on('khach_hang')->onDelete('cascade');
            $table->foreign('idPhuongThuc')->references('id')->on('phuong_thuc_thanh_toan')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_dat_hang');

    }
};
