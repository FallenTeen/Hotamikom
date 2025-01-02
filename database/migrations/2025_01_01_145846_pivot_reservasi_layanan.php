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
        Schema::create('pivot_reservasi_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasi_id')->constrained('tbl_reservasi')->onDelete('cascade');
            $table->foreignId('layanan_hotel_id')->constrained('tbl_layanan_hotel')->onDelete('cascade');
            $table->integer('jumlah')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_reservasi_layanan');
    }
};
