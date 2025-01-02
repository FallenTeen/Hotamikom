<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar');
            $table->enum('tipe_kamar',['vip','reguler']);
            $table->integer('harga_per_malam');
            $table->integer('kapasitas');
            $table->enum('status',['tersedia','terisi'])->default('tersedia');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kamar');
    }
};
