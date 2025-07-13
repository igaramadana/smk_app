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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa')->index();
            $table->unsignedBigInteger('id_kategori')->index();
            $table->unsignedBigInteger('id_petugas')->index();
            $table->timestamp('tanggal_pembayaran');
            $table->integer('jumlah_dibayar');
            $table->enum('metode_pembayaran', ['transfer', 'tunai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
