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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nama_alat');
            $table->integer('jumlah')->default(0);
            $table->string('keperluan');
            $table->timestamp('tanggal_peminjaman')->useCurrent();
            $table->timestamp('tanggal_pengembalian')->useCurrent();
            $table->timestamp('batas_pengembalian')->nullable();
            $table->string('keterlambatan')->nullable();
            $table->enum('kondisi_alat', ['baik', 'rusak'])->default('baik');
            $table->string('denda')->nullable();
            $table->string('catatan')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dipinjam', 'ditolak'])->default('menunggu');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
