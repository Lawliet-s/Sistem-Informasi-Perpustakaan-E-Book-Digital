<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create initial users for 3 roles
        User::create([
            'username' => 'admin',
            'nama_user' => 'Admin Pustakawan',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        User::create([
            'username' => 'petugas',
            'nama_user' => 'Petugas Sirkulasi',
            'password' => Hash::make('password'),
            'role' => 'Petugas',
        ]);

        User::create([
            'username' => 'siswa',
            'nama_user' => 'Siswa Anggota',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
        ]);

        // Sample books
        Buku::create([
            'isbn' => '978-602-8519-93-9',
            'judul_buku' => 'Enterprise Architecture & Laravel Advanced',
            'pengarang' => 'Tim RPL SMK',
            'stok_fisik' => 5,
            'file_pdf' => null,
            'cover_buku' => null,
        ]);

        Buku::create([
            'isbn' => '978-602-1234-56-7',
            'judul_buku' => 'Pemrograman Web Fullstack Modern',
            'pengarang' => 'Ahli IT',
            'stok_fisik' => 3,
            'file_pdf' => null,
            'cover_buku' => null,
        ]);
    }
}
