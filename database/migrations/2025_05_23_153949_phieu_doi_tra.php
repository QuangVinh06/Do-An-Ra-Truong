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
        Schema::create('phieu_doi_tra', function (Blueprint $table) {
            $table->increments('id');
            $table->date('NgayLap')->default(now());
            $table->string('MoTa');
            $table->decimal('GiaTri',10,2);
            $table->string('GhiChu')->nullable();
            $table->unsignedInteger('idKhachHang');
            $table->foreign('idKhachHang')->references('id')->on('khach_hang');

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
