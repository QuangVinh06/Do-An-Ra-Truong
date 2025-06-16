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
        Schema::create('hop_dong', function (Blueprint $table) {
            $table->increments('id');
            $table->date('NgayLap');
            $table->dateTime('ThoiGianHieuLuc');
            $table->dateTime('ThoiGianKetThuc');
            $table->dateTime('NgayGiaoHang');
            $table->string('NguoiGiaoHang');
            $table->decimal('Thue', 5, 2); 
            $table->decimal('GiaTriHopDong', 5, 2); 
            $table->decimal('TienCoc', 5, 2); 
            $table->string('TrangThaiCoc');
            $table->string('TrangThaiHopDong');
            $table->unsignedInteger('idKhachHang');
            $table->unsignedInteger('idPhieuDat');
            $table->timestamps();
            $table->foreign('idPhieuDat')->references('id')->on('phieu_dat_hang')->onDelete('cascade');
            $table->foreign('idKhachHang')->references('id')->on('khach_hang')->onDelete('cascade');
            $table->string('FileHopDong')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hop_dong');

    }
};
