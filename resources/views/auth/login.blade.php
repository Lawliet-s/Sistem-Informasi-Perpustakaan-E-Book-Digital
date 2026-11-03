<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk · SMK-LIB</title>
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
<body class="bg-[#171512] text-[#F1D6B3] min-h-screen relative flex items-center justify-center p-6 font-sans">
    <!-- Video Background - Full visibility -->
    <div class="fixed inset-0 w-full h-full overflow-hidden z-[-1]">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('background video/205634-927347905_medium.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-[#171512]/80 backdrop-blur-[2px]"></div>
    </div>

    <!-- Login Card Glassmorphism -->
    <div class="w-full max-w-md p-8 rounded-2xl bg-[#29221C]/75 backdrop-blur-md border border-[#A65E2E]/40 shadow-2xl relative z-10 space-y-6">
        <div class="text-center space-y-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#D88A42] to-[#A65E2E] mx-auto flex items-center justify-center font-bold text-[#171512] text-xl shadow-lg shadow-[#D88A42]/20">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-[#F1D6B3]">Masuk ke SMK-LIB</h2>
                <p class="text-xs text-[#D88A42] mt-1">Sistem Informasi Perpustakaan & E-Book Digital</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-3.5 rounded-xl bg-red-950/80 border border-red-500/50 text-red-200 text-xs flex items-center gap-2 backdrop-blur-md">
                <svg class="w-4 h-4 shrink-0 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Username / NIS / NIP
                </label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus placeholder="Masukkan username..." class="w-full px-4 py-2.5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-sm focus:outline-none focus:border-[#D88A42] transition shadow-inner">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Password
                </label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-sm focus:outline-none focus:border-[#D88A42] transition shadow-inner">
            </div>
            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-bold text-sm hover:opacity-95 transition shadow-lg shadow-[#D88A42]/20 flex items-center justify-center gap-2">
                <span>Masuk Sistem</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="/" class="text-xs text-[#D88A42] hover:underline flex items-center justify-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
