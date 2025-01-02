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
        Schema::create('tbl_layanan_hotel', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->integer('harga_layanan');
            $table->date('tgl_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_layanan_hotel');
    }
};