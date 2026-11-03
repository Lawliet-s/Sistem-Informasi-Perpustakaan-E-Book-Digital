<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ringkasan Petugas · SMK-LIB</title>
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
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-[#493020]/80 border border-[#A65E2E]/50 text-[#F1D6B3] text-sm font-medium">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Ringkasan Petugas
                </a>
                <a href="{{ route('petugas.sirkulasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-[#493020]/50 text-[#F1D6B3]/80 text-sm font-medium transition">
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
                <h1 class="text-3xl font-bold text-[#F1D6B3]">Dashboard Petugas Sirkulasi</h1>
                <p class="text-xs text-[#D88A42] mt-1">Ringkasan Transaksi Sirkulasi & Pengawasan Denda Keterlambatan</p>
            </div>
            <div class="px-4 py-2 rounded-xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 text-xs text-[#F1D6B3]/80">
                {{ now()->format('d M Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-2 shadow-xl">
                <span class="text-xs text-[#D88A42] font-medium">Transaksi Aktif</span>
                <div class="text-3xl font-bold text-[#F1D6B3]">{{ $peminjamen->whereNull('tgl_kembali_real')->count() }}</div>
            </div>
            <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-2 shadow-xl">
                <span class="text-xs text-[#D88A42] font-medium">Total Seluruh Transaksi</span>
                <div class="text-3xl font-bold text-[#F1D6B3]">{{ $peminjamen->count() }}</div>
            </div>
            <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-2 shadow-xl">
                <span class="text-xs text-[#D88A42] font-medium">Tarif Denda Harian</span>
                <div class="text-2xl font-bold text-[#F1D6B3]">Rp 1.000 <span class="text-xs text-[#F1D6B3]/60">/ hari</span></div>
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-6 shadow-xl">
            <h2 class="text-xl font-bold text-[#F1D6B3] border-b border-[#A65E2E]/20 pb-3 flex items-center justify-between">
                <span>Menu Navigasi Petugas</span>
                <a href="{{ route('petugas.sirkulasi') }}" class="px-4 py-2 rounded-xl bg-[#A65E2E] hover:bg-[#D88A42] text-[#171512] font-bold text-xs transition">
                    Buka Menu Sirkulasi & Input Pinjam →
                </a>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/25 space-y-2">
                    <h3 class="font-bold text-[#F1D6B3] text-base">Pencatatan Peminjaman Buku</h3>
                    <p class="text-xs text-[#F1D6B3]/70">Catat transaksi peminjaman fisik buku baru untuk siswa secara langsung di meja sirkulasi.</p>
                    <a href="{{ route('petugas.sirkulasi') }}" class="inline-block mt-2 text-xs font-semibold text-[#D88A42] hover:underline">Buka form peminjaman →</a>
                </div>
                <div class="p-5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/25 space-y-2">
                    <h3 class="font-bold text-[#F1D6B3] text-base">Pengembalian & Kalkulasi Denda</h3>
                    <p class="text-xs text-[#F1D6B3]/70">Proses pengembalian buku dan hitung denda keterlambatan otomatis (Rp1.000/hari).</p>
                    <a href="{{ route('petugas.sirkulasi') }}" class="inline-block mt-2 text-xs font-semibold text-[#D88A42] hover:underline">Kelola sirkulasi & pengembalian →</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
