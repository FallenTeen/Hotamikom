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
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reservasi');
            $table->foreign('id_reservasi')->references('id')->on('tbl_reservasi')->onDelete('cascade');
            $table->date('tgl_pembayaran')->nullable();
            $table->integer('jumlah_pembayaran');
            $table->enum('metode_pembayaran', ['cash', 'transfer'])->default('cash');
            $table->enum('status_pembayaran', ['pending', 'approved', 'canceled'])->default('pending');
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
