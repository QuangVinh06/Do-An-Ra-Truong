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
        Schema::create('phan_quyen', function (Blueprint $table) {
            $table->unsignedInteger('idTaiKhoan');
            $table->unsignedInteger('idQuyen');
            $table->primary(['idTaiKhoan', 'idQuyen']);
            $table->foreign('idTaiKhoan')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idQuyen')->references('id')->on('quyens')->onDelete('cascade');
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
