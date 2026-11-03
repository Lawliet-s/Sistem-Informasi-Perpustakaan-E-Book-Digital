<?php

use App\Http\Controllers\DashboardController;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
});

Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Siswa Multi-Page Routes
    Route::get('/siswa/katalog', [DashboardController::class, 'siswaIndex'])->name('siswa.katalog');
    Route::get('/siswa/riwayat', [DashboardController::class, 'siswaRiwayat'])->name('siswa.riwayat');
    Route::get('/admin/buku', [DashboardController::class, 'bukuCreate'])->name('admin.buku');
    Route::post('/admin/buku', [DashboardController::class, 'bukuStore'])->name('admin.buku.store');
    Route::put('/admin/buku/{id}', [DashboardController::class, 'bukuUpdate'])->name('admin.buku.update');
    Route::delete('/admin/buku/{id}', [DashboardController::class, 'bukuDestroy'])->name('admin.buku.destroy');

    Route::get('/admin/users', [DashboardController::class, 'userCreate'])->name('admin.users');
    Route::post('/admin/users', [DashboardController::class, 'userStore'])->name('admin.users.store');

    // Petugas Sirkulasi Routes
    Route::get('/petugas/sirkulasi', [DashboardController::class, 'petugasIndex'])->name('petugas.sirkulasi');
    Route::post('/petugas/sirkulasi', [DashboardController::class, 'petugasStorePeminjaman'])->name('petugas.sirkulasi.store');
    Route::get('/petugas/buku', [DashboardController::class, 'petugasBukuCreate'])->name('petugas.buku');
    Route::post('/petugas/buku', [DashboardController::class, 'petugasBukuStore'])->name('petugas.buku.store');

    // Cetak Kartu Peminjaman PDF
    Route::get('/peminjaman/{id}/cetak-kartu', [DashboardController::class, 'cetakKartu'])->name('peminjaman.cetak');
    Route::post('/peminjaman', function (Request $request) {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->id_buku);
        if ($buku->stok_fisik < $request->jumlah_pinjam) {
            return back()->withErrors(['stok' => 'Stok fisik buku tidak mencukupi.']);
        }

        $buku->decrement('stok_fisik', $request->jumlah_pinjam);

        $peminjaman = Peminjaman::create([
            'kode_transaksi' => 'TRX-LIB-'.date('Ymd').'-'.rand(100, 999),
            'id_siswa' => auth()->id(),
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => now()->addDays(7),
        ]);

        $peminjaman->details()->create([
            'id_buku' => $buku->id_buku,
            'jumlah_pinjam' => $request->jumlah_pinjam,
        ]);

        return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil dicatat & stok berkurang otomatis.');
    })->name('peminjaman.store');

    // Kalkulasi Denda & Pengembalian
    Route::post('/peminjaman/{id}/kembali', function ($id) {
        $peminjaman = Peminjaman::findOrFail($id);
        $tglReal = now();
        $rencana = Carbon::parse($peminjaman->tgl_kembali_rencana);

        $denda = 0;
        if ($tglReal->greaterThan($rencana)) {
            $selisihHari = (int) $rencana->copy()->startOfDay()->diffInDays($tglReal->copy()->startOfDay());
            $denda = $selisihHari * 1000;
        }

        $peminjaman->update([
            'tgl_kembali_real' => $tglReal,
            'denda' => $denda,
        ]);

        foreach ($peminjaman->details as $detail) {
            $detail->buku->increment('stok_fisik', $detail->jumlah_pinjam);
        }

        return redirect()->route('dashboard')->with('success', 'Buku dikembalikan. Denda: Rp '.number_format($denda, 0, ',', '.'));
    })->name('peminjaman.kembali');
});
