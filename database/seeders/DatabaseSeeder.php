<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create default users
        $admin = User::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'password' => 'password',
            'role' => 'admin',
            'status_aktif' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Petugas',
            'username' => 'petugas',
            'password' => 'password',
            'role' => 'petugas',
            'status_aktif' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Peminjam',
            'username' => 'peminjam',
            'password' => 'password',
            'role' => 'peminjam',
            'status_aktif' => true,
        ]);

        Kategori::create([
            'nama_kategori' => 'Alat Listrik',
            'deskripsi' => 'Kategori untuk alat-alat listrik.',
        ]);

        Alat::create([
            'kode_alat' => 'ALAT001',
            'nama_alat' => 'Bor Listrik',
            'jumlah_alat' => 5,
            'kondisi' => 'Baik',
            'deskripsi' => 'Bor listrik untuk keperluan proyek.',
            'gambar' => null,
            'status' => true,
            'created_by' => $admin->id,
        ]);

        Peminjaman::create([
            'nama_peminjam' => 'Peminjam',
            'nama_alat' => 'Bor Listrik',
            'jumlah' => 1,
            'keperluan' => 'Proyek rumah',
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(7),
            'batas_pengembalian' => now()->addDays(7),
            'keterlambatan' => null,
            'kondisi_alat' => 'Baik',
            'denda' => null,
            'catatan' => null,
            'status' => 'menunggu',
        ]);

        Pengembalian::create([
            'nama_peminjam' => 'Peminjam',
            'nama_alat' => 'Bor Listrik',
            'jumlah' => 1,
            'keperluan' => 'Proyek rumah',
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(7),
            'batas_pengembalian' => now()->addDays(7),
            'keterlambatan' => null,
            'kondisi_alat' => 'Baik',
            'denda' => null,
            'catatan' => null,
            'status' => 'menunggu',
        ]);

        LogAktivitas::create([
            'user_id' => $admin->id,
            'aktivitas' => 'Membuat akun admin',
            'created_at' => now(),
        ]);
    }
}
