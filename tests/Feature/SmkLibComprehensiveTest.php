<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmkLibComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_login_and_dashboard_render_successfully(): void
    {
        $user = User::create([
            'username' => 'siswa_test',
            'nama_user' => 'Siswa Test',
            'password' => bcrypt('password'),
            'role' => 'Siswa',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Siswa Test');
    }

    public function test_peminjaman_reduces_stock_automatically(): void
    {
        $user = User::create([
            'username' => 'siswa_pinjam',
            'nama_user' => 'Siswa Pinjam',
            'password' => bcrypt('password'),
            'role' => 'Siswa',
        ]);

        $buku = Buku::create([
            'isbn' => '978-123-456-789',
            'judul_buku' => 'Test Buku',
            'pengarang' => 'Penulis',
            'stok_fisik' => 5,
        ]);

        $response = $this->actingAs($user)->post('/peminjaman', [
            'id_buku' => $buku->id_buku,
            'jumlah_pinjam' => 2,
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertEquals(3, $buku->fresh()->stok_fisik);
        $this->assertDatabaseHas('peminjaman', ['id_siswa' => $user->id_user]);
        $this->assertDatabaseHas('detail_peminjaman', ['id_buku' => $buku->id_buku, 'jumlah_pinjam' => 2]);
    }

    public function test_pengembalian_calculates_denda_and_restores_stock(): void
    {
        $user = User::create([
            'username' => 'siswa_kembali',
            'nama_user' => 'Siswa Kembali',
            'password' => bcrypt('password'),
            'role' => 'Siswa',
        ]);

        $buku = Buku::create([
            'isbn' => '978-987-654-321',
            'judul_buku' => 'Test Buku Denda',
            'pengarang' => 'Penulis',
            'stok_fisik' => 2,
        ]);

        $buku->decrement('stok_fisik', 1); // Stok jadi 1

        $peminjaman = Peminjaman::create([
            'kode_transaksi' => 'TRX-TEST-001',
            'id_siswa' => $user->id_user,
            'tgl_pinjam' => now()->subDays(10),
            'tgl_kembali_rencana' => now()->subDays(3), // Terlambat 3 hari
        ]);

        $peminjaman->details()->create([
            'id_buku' => $buku->id_buku,
            'jumlah_pinjam' => 1,
        ]);

        $petugas = User::create([
            'username' => 'petugas_test',
            'nama_user' => 'Petugas Test',
            'password' => bcrypt('password'),
            'role' => 'Petugas',
        ]);

        $response = $this->actingAs($petugas)->post("/peminjaman/{$peminjaman->id_peminjaman}/kembali");

        $response->assertRedirect('/dashboard');

        $peminjaman->refresh();
        $this->assertNotNull($peminjaman->tgl_kembali_real);
        $this->assertEquals(3000, $peminjaman->denda); // 3 hari * 1000
        $this->assertEquals(2, $buku->fresh()->stok_fisik); // Stok kembali 2
    }
}
