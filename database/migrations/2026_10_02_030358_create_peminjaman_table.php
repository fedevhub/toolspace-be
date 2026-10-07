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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nama_alat');
            $table->integer('jumlah')->default(0);
            $table->string('keperluan');
            $table->timestamp('tanggal_peminjaman')->useCurrent();
            $table->timestamp('batas_pengembalian')->nullable();
            $table->enum('status', ['menunggu', 'disetujui','dipinjam', 'ditolak'])->default('menunggu');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
