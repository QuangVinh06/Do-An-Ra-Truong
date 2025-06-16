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
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('SoTienThanhToan', 20, 2);
            $table->date('NgayLap');
            $table->string('LoaiThanhToan');
            $table->unsignedInteger('idHopDong');
            $table->string('PhuongThuc')->nullable();
            $table->string('MaGiaoDich')->nullable();
            $table->timestamps();
            $table->foreign('idHopDong')->references('id')->on('hop_dong')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');

    }
};
