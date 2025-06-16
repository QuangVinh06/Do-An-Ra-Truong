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
        Schema::create('khach_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idLoaiKhachHang');
            $table->unsignedInteger('idTaiKhoan');
            $table->string('DiaChi',255)->nullable();
            $table->char('SoDienThoai',15)->nullable();
            $table->timestamps();
            $table->foreign('idLoaiKhachHang')->references('id')->on('loai_khach_hangs')->onDelete('cascade');
            $table->foreign('idTaiKhoan')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hang');

    }
};
