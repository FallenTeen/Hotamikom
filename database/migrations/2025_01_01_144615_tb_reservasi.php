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
        Schema::create('tbl_reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('Users');
            $table->foreignId('id_kamar')->constrained('tbl_kamar');
            $table->integer('id_layanan')->constrained('tbl_layanan')->nullable();
            $table->date('tgl_checkin');
            $table->date('tgl_checkout');
            $table->integer('total_harga');
            $table->enum('status',['pending','approved','canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_reservasi');
    }
};
