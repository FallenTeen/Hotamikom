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
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reservasi')->constrained('tbl_reservasi');
            $table->date('tgl_pembayaran');
            $table->integer('jumlah_pembayaran');
            $table->enum('metode_pembayaran',['cash','transfer']);
            $table->enum('status_pembayaran',['pending','approved','canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
};
