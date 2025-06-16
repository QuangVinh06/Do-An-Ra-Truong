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
        Schema::create('loai_san_phams', function (Blueprint $table) {
            $table->increments('id'); // Khóa chính
            $table->string('TenLoaiSanPham', 100); // NVARCHAR(100)
            $table->boolean('TrangThai')->default(1); // Trạng thái (1: hoạt động, 0: không hoạt động)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_san_phams');
    }
};
