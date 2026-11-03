<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Buku Master · SMK-LIB</title>
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

    <!-- Sidebar Admin -->
    <aside class="w-64 bg-[#29221C]/90 backdrop-blur-md border-r border-[#A65E2E]/30 flex flex-col justify-between p-6 z-50 min-h-screen sticky top-0">
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#D88A42] to-[#A65E2E] flex items-center justify-center font-bold text-[#171512] text-lg shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <span class="font-bold tracking-wider text-[#F1D6B3] block">SMK-LIB</span>
                    <span class="text-xs text-[#D88A42]">Admin / Pustakawan</span>
                </div>
            </div>

            <nav class="space-y-1.5 pt-4 border-t border-[#A65E2E]/20">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-[#493020]/50 text-[#F1D6B3]/80 text-sm font-medium transition">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Ringkasan Admin
                </a>
                <a href="{{ route('admin.buku') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-[#493020]/80 border border-[#A65E2E]/50 text-[#F1D6B3] text-sm font-medium">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Kelola Buku Master
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-[#493020]/50 text-[#F1D6B3]/80 text-sm font-medium transition">
                    <svg class="w-5 h-5 text-[#D88A42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Kelola Pengguna
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
                <h1 class="text-3xl font-bold text-[#F1D6B3]">Kelola Buku Master & Upload E-Book PDF</h1>
                <p class="text-xs text-[#D88A42] mt-1">Tambah, Edit, Hapus Buku, serta Unggah File E-Book PDF untuk Siswa</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-[#29221C]/80 hover:bg-[#493020] border border-[#A65E2E]/40 text-xs text-[#F1D6B3] transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Tambah Buku -->
            <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-6 shadow-xl lg:col-span-1">
                <h2 class="text-xl font-bold text-[#F1D6B3] border-b border-[#A65E2E]/20 pb-3">Tambah Buku & E-Book</h2>
                <form method="POST" action="{{ route('admin.buku.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">ISBN</label>
                        <input type="text" name="isbn" required placeholder="978-xxx-xxx" class="w-full px-4 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-xs focus:outline-none focus:border-[#D88A42]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Judul Buku</label>
                        <input type="text" name="judul_buku" required placeholder="Judul..." class="w-full px-4 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-xs focus:outline-none focus:border-[#D88A42]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Pengarang</label>
                        <input type="text" name="pengarang" required placeholder="Penulis..." class="w-full px-4 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] placeholder-[#F1D6B3]/30 text-xs focus:outline-none focus:border-[#D88A42]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Stok Fisik</label>
                        <input type="number" name="stok_fisik" required min="0" value="5" class="w-full px-4 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs focus:outline-none focus:border-[#D88A42]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">File E-Book PDF (Opsional)</label>
                        <input type="file" name="file_pdf" accept=".pdf" class="w-full px-3 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#A65E2E] file:text-[#171512]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#F1D6B3]/80 mb-1">Cover Buku / E-Book (Opsional)</label>
                        <input type="file" name="cover_buku" accept="image/*" class="w-full px-3 py-2 rounded-xl bg-[#171512]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#A65E2E] file:text-[#171512]">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-[#D88A42] to-[#A65E2E] text-[#171512] font-bold text-xs hover:opacity-95 transition shadow-lg">
                        Simpan Buku & E-Book
                    </button>
                </form>
            </div>

            <!-- List Buku & Edit Form Inline -->
            <div class="p-6 rounded-2xl bg-[#29221C]/70 backdrop-blur-md border border-[#A65E2E]/30 space-y-6 shadow-xl lg:col-span-2">
                <h2 class="text-xl font-bold text-[#F1D6B3] border-b border-[#A65E2E]/20 pb-3">Daftar & Edit Master Buku</h2>
                <div class="space-y-4 max-h-[550px] overflow-y-auto pr-3 custom-scrollbar">
                    @foreach($bukus as $b)
                        <div class="p-4 rounded-xl bg-[#171512]/80 border border-[#A65E2E]/25 space-y-3">
                            <form method="POST" action="{{ route('admin.buku.update', $b->id_buku) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                                @csrf
                                @method('PUT')
                                <div class="md:col-span-3">
                                    <label class="block text-[10px] text-[#D88A42] mb-1">ISBN</label>
                                    <input type="text" name="isbn" value="{{ $b->isbn }}" required class="w-full px-3 py-1.5 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs">
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block text-[10px] text-[#D88A42] mb-1">Judul Buku</label>
                                    <input type="text" name="judul_buku" value="{{ $b->judul_buku }}" required class="w-full px-3 py-1.5 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-[10px] text-[#D88A42] mb-1">Pengarang</label>
                                    <input type="text" name="pengarang" value="{{ $b->pengarang }}" required class="w-full px-3 py-1.5 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-[10px] text-[#D88A42] mb-1">Stok Fisik</label>
                                    <input type="number" name="stok_fisik" value="{{ $b->stok_fisik }}" required min="0" class="w-full px-3 py-1.5 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs">
                                </div>
                                <div class="md:col-span-12">
                                    <label class="block text-[10px] text-[#D88A42] mb-1">Ganti File PDF & Cover Buku (Opsional)</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                        <input type="file" name="file_pdf" accept=".pdf" class="w-full px-3 py-1 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs file:mr-2 file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-[#A65E2E] file:text-[#171512]" title="PDF">
                                        <input type="file" name="cover_buku" accept="image/*" class="w-full px-3 py-1 rounded-lg bg-[#29221C]/70 border border-[#A65E2E]/30 text-[#F1D6B3] text-xs file:mr-2 file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-[#A65E2E] file:text-[#171512]" title="Cover Image">
                                    </div>
                                </div>
                                <div class="md:col-span-12 flex justify-between items-center pt-2 border-t border-[#A65E2E]/10">
                                    <button type="submit" class="px-4 py-1.5 rounded-lg bg-[#A65E2E] hover:bg-[#D88A42] text-[#171512] font-bold text-xs transition">
                                        Update Buku
                                    </button>
                            </form>
                                    <form method="POST" action="{{ route('admin.buku.destroy', $b->id_buku) }}" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-950 hover:bg-red-900 border border-red-500/40 text-red-200 text-xs font-semibold transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>
</html>
