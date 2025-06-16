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
        Schema::create('khuyen_mais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TenKhuyenMai')->unique();
            $table->decimal('GiamGia',10,2);
            $table->tinyInteger('TrangThai')->default(1);
            $table->unsignedInteger('idLoaiKhachHang');
            $table->foreign('idLoaiKhachHang')->references('id')->on('loai_khach_hangs');
            $table->timestamps();
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
