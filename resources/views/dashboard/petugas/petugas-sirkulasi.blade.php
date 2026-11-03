<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirkulasi & Input Pinjam · Petugas SMK-LIB</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @php
        $manifest = public_path('build/manifest.json');
    @endphp
    @if (file_exists($manifest))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>
<body class="bg-[#171512] text-[#F1D6B3] min-h-screen relative flex font-sans">
    <div class="fixed inset-0 w-full h-full overflow-hidden z-[-1]">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('background video/205634-927347905_medium.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-[#171512]/80 backdrop-blur-[2px]"></div>
    </div>

    <!-- Sidebar Petugas -->
    <aside class="w-64 bg-[#29221C]/90 backdrop-blur-md border-r border-[#A65E2E]/30 flex flex-col justify-between p-6 z-50 min-h-screen sticky top-0">
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#D88A42] to-[#A65E2E] flex items-center justify-center font-bold text-[#171512] text-lg shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div>
                    <span class="font-bold tracking-wider text-[#F1D6B3] block">SMK-LIB</span>
                    <span class="text-xs text-[#D88A42]">Petugas Sirkulasi</span>
                </div>
            </div>

            <nav class="space-y-1.5 pt-4 border-t border-[#A65E2E]/20">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-[#493020]/50 text-[#F1D6B3]/80 text-sm font-medium transition">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Ringkasan Petugas
                </a>
                <a href="{{ route('petugas.sirkulasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-[#493020]/80 border border-[#A65E2E]/50 text-[#F1D6B3] text-sm font-medium">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Sirkulasi & Input Pinjam
                </a>
                <a href="{{ route('petugas.buku') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-[#493020]/50 text-[#F1D6B3]/80 text-sm font-medium transition">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tambah Buku Baru
                </a>
            </nav>
        </div>

        <div class="pt-6 border-t border-[#A65E2E]/20 space-y-4">
            <div class="text-xs text-[#F1D6B3]/70">
                Login sebagai:<br>
                <strong class="text-[#D88A42]">{{ $user->nama_user }}</strong>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-2.5 px-4 rounded-lg bg-red-950/80 hover:bg-red-900 border border-red-500/40 text-red-200 text-xs font-semibold transition flex items-center justify-center gap-2 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto z-10 space-y-8 fade-in">
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-950/80 border border-emerald-500/50 text-emerald-200 text-sm flex items-center gap-3 backdrop-blur-md">
                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-950/80 border border-red-500/50 text-red-200 text-sm flex items-center gap-3 backdrop-blur-md">
                <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-[#F1D6B3]">Manajemen Sirkulasi & Multi-Buku Pinjam</h1>
                <p class="text-xs text-[#D88A42] mt-1">Pencatatan Transaksi Peminjaman Multi-Buku (Sekaligus) & Pengembalian</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-[#29221C]/80 hover:bg-[#493020] border border-[#A65E2E]/40 text-xs text-[#F1D6B3] transition">
                ← Kembali ke Ringkasan
            </a>
        </div>

        <!-- Input Transaksi Multi-Buku oleh Petugas -->
        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-6 shadow-xl max-w-4xl">
            <h2 class="text-xl font-bold text-[#F1D6B3] border-b border-[#A65E2E]/20 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Catat Peminjaman Multi-Buku dalam 1 Transaksi
            </h2>
            <form method="POST" action="{{ route('petugas.sirkulasi.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Pilih Siswa Peminjam</label>
                        <select name="id_siswa" required class="w-full px-3.5 py-2.5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs focus:outline-none focus:border-[#D88A42]">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id_user }}">{{ $siswa->nama_user }} ({{ $siswa->username }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Tanggal Rencana Kembali</label>
                        <input type="date" name="tgl_kembali_rencana" required value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="w-full px-3.5 py-2.5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs focus:outline-none focus:border-[#D88A42]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-2">Pilih Buku yang Dipinjam (Bisa pilih lebih dari satu)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-[250px] overflow-y-auto p-3 rounded-xl bg-[#171512]/60 border border-[#A65E2E]/20">
                        @foreach($bukus as $buku)
                            <label class="flex items-center gap-3 p-2.5 rounded-lg bg-[#29221C]/80 border border-[#A65E2E]/20 hover:border-[#D88A42] cursor-pointer transition">
                                <input type="checkbox" name="buku_ids[]" value="{{ $buku->id_buku }}" class="w-4 h-4 rounded text-[#D88A42] focus:ring-0 bg-[#171512] border-[#A65E2E]/40">
                                <div class="text-xs">
                                    <div class="font-bold text-[#F1D6B3]">{{ $buku->judul_buku }}</div>
                                    <div class="text-[#D88A42]">Stok: {{ $buku->stok_fisik }} eks</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="py-3 px-8 rounded-xl bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-bold text-xs hover:opacity-95 transition shadow-lg">
                        Proses Transaksi Multi-Buku & Kurangi Stok
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter / Search & Daftar Transaksi -->
        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-6 shadow-xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-[#A65E2E]/20 pb-4">
                <h2 class="text-xl font-bold text-[#F1D6B3] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Daftar Transaksi & Pengembalian
                </h2>
                <form method="GET" action="{{ route('petugas.sirkulasi') }}" class="flex gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode / nama siswa..." class="px-3.5 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-xs focus:outline-none focus:border-[#D88A42] w-full md:w-64">
                    <button type="submit" class="px-4 py-2 rounded-xl bg-[#A65E2E] hover:bg-[#D88A42] text-[#171512] font-bold text-xs transition">
                        Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-[#F1D6B3]/90">
                    <thead class="bg-[#171512]/85 text-[#D88A42] text-xs uppercase border-b border-[#A65E2E]/30">
                        <tr>
                            <th class="p-3">Kode Transaksi</th>
                            <th class="p-3">Siswa Peminjam</th>
                            <th class="p-3">Daftar Buku Dipinjam (Multi-Buku)</th>
                            <th class="p-3">Tgl Pinjam</th>
                            <th class="p-3">Rencana Kembali</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Denda</th>
                            <th class="p-3 text-center">Aksi Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#A65E2E]/15">
                        @forelse($peminjamen as $trx)
                            <tr class="hover:bg-[#493020]/35 transition">
                                <td class="p-3 font-mono font-bold text-[#F1D6B3]">{{ $trx->kode_transaksi }}</td>
                                <td class="p-3">
                                    <div class="font-bold text-[#F1D6B3]">{{ $trx->siswa->nama_user ?? '-' }}</div>
                                    <div class="text-xs text-[#D88A42]">@ {{ $trx->siswa->username ?? '-' }}</div>
                                </td>
                                <td class="p-3">
                                    <ul class="space-y-1">
                                        @foreach($trx->details as $detail)
                                            <li class="text-xs bg-[#171512]/60 px-2.5 py-1 rounded-lg border border-[#A65E2E]/20 flex justify-between gap-2">
                                                <span class="font-medium text-[#F1D6B3]">{{ $detail->buku->judul_buku ?? 'Buku Dihapus' }}</span>
                                                <span class="text-[#D88A42] shrink-0">({{ $detail->jumlah_pinjam }} eks)</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-3">{{ $trx->tgl_pinjam }}</td>
                                <td class="p-3">{{ $trx->tgl_kembali_rencana }}</td>
                                <td class="p-3">
                                    @if($trx->tgl_kembali_real)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-200 text-xs font-semibold">Dikembalikan</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-[#D88A42]/20 border border-[#D88A42]/40 text-[#D88A42] text-xs font-semibold">Dipinjam</span>
                                    @endif
                                </td>
                                <td class="p-3 text-[#D88A42] font-semibold">Rp {{ number_format($trx->denda, 0, ',', '.') }}</td>
                                <td class="p-3 text-center space-y-1">
                                    <a href="{{ route('peminjaman.cetak', $trx->id_peminjaman) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-[#D88A42] hover:bg-[#A65E2E] text-[#171512] font-bold text-xs transition shadow inline-flex items-center gap-1 mx-auto">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        Cetak Kartu PDF
                                    </a>
                                    @if(!$trx->tgl_kembali_real)
                                        <form method="POST" action="{{ route('peminjaman.kembali', $trx->id_peminjaman) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-[#A65E2E] hover:bg-[#D88A42] text-[#171512] font-bold text-xs transition shadow inline-flex items-center gap-1 mx-auto">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Proses Kembali
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-[#F1D6B3]/45 block">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-[#F1D6B3]/50">Belum ada transaksi peminjaman ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
