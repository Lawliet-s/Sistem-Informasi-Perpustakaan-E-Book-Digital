<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMK-LIB · Sistem Informasi Perpustakaan & E-Book Digital</title>
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
<body class="bg-[#171512] text-[#F1D6B3] min-h-screen relative overflow-x-hidden font-sans flex flex-col justify-between">
    <!-- Video Background - Full visibility, gentle dark vignette -->
    <div class="fixed inset-0 w-full h-full overflow-hidden z-[-1]">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('background video/205634-927347905_medium.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-t from-[#171512] via-transparent to-[#171512]/60"></div>
    </div>

    <!-- Header Navigation -->
    <header class="w-full max-w-7xl mx-auto p-6 flex justify-between items-center z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#D88A42] to-[#A65E2E] flex items-center justify-center shadow-lg shadow-[#D88A42]/20 font-bold text-[#171512] text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <span class="font-bold tracking-wider text-lg text-[#F1D6B3] block">SMK-LIB</span>
                <span class="text-xs text-[#D88A42]/90 tracking-wide">Advanced 7 · E-Library</span>
            </div>
        </div>
        <nav class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-lg bg-[#29221C]/80 hover:bg-[#493020] border border-[#A65E2E]/40 text-[#F1D6B3] text-sm font-medium transition shadow-md backdrop-blur-md">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-5 py-2 rounded-lg bg-[#29221C]/80 hover:bg-[#493020] border border-[#A65E2E]/40 text-[#F1D6B3] text-sm font-medium transition shadow-md backdrop-blur-md">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-semibold text-sm hover:opacity-95 transition shadow-lg shadow-[#D88A42]/20">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center z-10 my-auto">
        <div class="lg:col-span-7 space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#493020]/80 border border-[#A65E2E]/50 text-[#D88A42] text-xs font-medium tracking-wide backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-[#D88A42] animate-pulse"></span>
                Uji Kompetensi Keahlian RPL · Paket Advanced 7
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold tracking-tight text-[#F1D6B3] leading-tight">
                Sistem Informasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D88A42] to-[#A65E2E]">Perpustakaan & E-Book</span> Digital
            </h1>
            <p class="text-[#F1D6B3]/80 text-base lg:text-lg leading-relaxed max-w-2xl">
                Platform enterprise manajemen sirkulasi buku fisik, kalkulasi denda otomatis, booking peminjaman, serta pembacaan e-book PDF langsung dalam satu ekosistem yang nyaman.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-7 py-3 rounded-xl bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-bold text-base hover:opacity-95 transition shadow-xl shadow-[#D88A42]/20 flex items-center gap-2">
                        Buka Dashboard 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-7 py-3 rounded-xl bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-bold text-base hover:opacity-95 transition shadow-xl shadow-[#D88A42]/20 flex items-center gap-2">
                        Mulai Masuk
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @endauth
                <a href="#features" class="px-7 py-3 rounded-xl bg-[#29221C]/80 hover:bg-[#493020] border border-[#A65E2E]/40 text-[#F1D6B3] font-medium text-base transition backdrop-blur-md">
                    Fitur Unggulan
                </a>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="p-6 lg:p-8 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 shadow-2xl space-y-6">
                <h3 class="text-xl font-bold text-[#F1D6B3] border-b border-[#A65E2E]/20 pb-4">Statistik & Sistem</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-[#171512]/60 border border-[#A65E2E]/25">
                        <span class="text-xs text-[#D88A42] block mb-1 font-medium">Koleksi Buku</span>
                        <span class="text-2xl font-bold text-[#F1D6B3]">1,420+</span>
                    </div>
                    <div class="p-4 rounded-xl bg-[#171512]/60 border border-[#A65E2E]/25">
                        <span class="text-xs text-[#D88A42] block mb-1 font-medium">E-Book Digital</span>
                        <span class="text-2xl font-bold text-[#F1D6B3]">350+</span>
                    </div>
                    <div class="p-4 rounded-xl bg-[#171512]/60 border border-[#A65E2E]/25">
                        <span class="text-xs text-[#D88A42] block mb-1 font-medium">Role Pengguna</span>
                        <span class="text-xl font-bold text-[#F1D6B3]">3 Level</span>
                    </div>
                    <div class="p-4 rounded-xl bg-[#171512]/60 border border-[#A65E2E]/25">
                        <span class="text-xs text-[#D88A42] block mb-1 font-medium">Denda Harian</span>
                        <span class="text-xl font-bold text-[#F1D6B3]">Rp 1.000</span>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="w-full max-w-7xl mx-auto px-6 py-16 z-10 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-3 hover:border-[#A65E2E]/60 transition">
            <div class="w-12 h-12 rounded-xl bg-[#D88A42]/20 border border-[#D88A42]/40 flex items-center justify-center text-[#D88A42]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h4 class="text-lg font-bold text-[#F1D6B3]">Manajemen Buku & E-Book</h4>
            <p class="text-sm text-[#F1D6B3]/70 leading-relaxed">
                Kelola master buku lengkap dengan ISBN, stok fisik, serta pembacaan file PDF e-book langsung di web viewer.
            </p>
        </div>
        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-3 hover:border-[#A65E2E]/60 transition">
            <div class="w-12 h-12 rounded-xl bg-[#D88A42]/20 border border-[#D88A42]/40 flex items-center justify-center text-[#D88A42]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <h4 class="text-lg font-bold text-[#F1D6B3]">Sirkulasi & Auto Stok</h4>
            <p class="text-sm text-[#F1D6B3]/70 leading-relaxed">
                Peminjaman multi-buku dalam satu transaksi dengan pemotongan stok otomatis serta kalkulasi denda harian yang akurat.
            </p>
        </div>
        <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-3 hover:border-[#A65E2E]/60 transition">
            <div class="w-12 h-12 rounded-xl bg-[#D88A42]/20 border border-[#D88A42]/40 flex items-center justify-center text-[#D88A42]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h4 class="text-lg font-bold text-[#F1D6B3]">Multi-Role Akses</h4>
            <p class="text-sm text-[#F1D6B3]/70 leading-relaxed">
                Hak akses terstruktur untuk Admin/Pustakawan, Petugas Sirkulasi, dan Siswa/Anggota perpustakaan.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full text-center py-6 text-xs text-[#F1D6B3]/60 z-10 border-t border-[#A65E2E]/20 mt-12 bg-[#171512]/90 backdrop-blur-md">
        &copy; {{ date('Y') }} SMK-LIB · Paket Advanced 7 Uji Kompetensi Keahlian RPL. All rights reserved.
    </footer>
</body>
</html>
