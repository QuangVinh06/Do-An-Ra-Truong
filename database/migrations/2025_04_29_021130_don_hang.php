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
        Schema::create('don_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('TongTienThanhToan', 20, 2);
            $table->date('NgayLap');
            $table->unsignedInteger('idHopDong');
            $table->string('TrangThai');
            $table->timestamps();
            $table->foreign('idHopDong')->references('id')->on('hop_dong')->onDelete('cascade');

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
