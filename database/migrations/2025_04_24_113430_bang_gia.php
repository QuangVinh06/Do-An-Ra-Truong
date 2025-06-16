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
        Schema::create('bang_gia', function (Blueprint $table) {
            $table->increments('id');
            $table->date('NgayLap');
            $table->text('GhiChu');
            $table->unsignedInteger('idSanPham');
            $table->foreign('idSanPham')->references('id')->on('san_phams')->onDelete('cascade');
            $table->integer('Gia')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_gia');

    }
};
