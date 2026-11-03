<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $bukus = Buku::all();
        $peminjamen = Peminjaman::with(['siswa', 'details.buku'])->latest()->get();

        if ($user->role === 'Admin') {
            $users = User::all();
            return view('dashboard.admin.admin', compact('user', 'bukus', 'peminjamen', 'users'));
        }

        if ($user->role === 'Petugas') {
            return view('dashboard.petugas.petugas', compact('user', 'bukus', 'peminjamen'));
        }

        return view('dashboard.siswa.siswa', compact('user', 'bukus', 'peminjamen'));
    }

    public function bukuCreate()
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }
        $bukus = Buku::all();
        return view('dashboard.admin.admin-buku', compact('user', 'bukus'));
    }

    public function bukuUpdate(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }

        $buku = Buku::findOrFail($id);

        $request->validate([
            'isbn' => 'required|unique:buku,isbn,' . $id . ',id_buku',
            'judul_buku' => 'required|string|max:150',
            'pengarang' => 'required|string|max:100',
            'stok_fisik' => 'required|integer|min:0',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->only(['isbn', 'judul_buku', 'pengarang', 'stok_fisik']);

        if ($request->hasFile('file_pdf')) {
            if ($buku->file_pdf && file_exists(public_path($buku->file_pdf))) {
                @unlink(public_path($buku->file_pdf));
            }
            $file = $request->file('file_pdf');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('ebooks'), $filename);
            $data['file_pdf'] = 'ebooks/' . $filename;
        }

        if ($request->hasFile('cover_buku')) {
            if ($buku->cover_buku && file_exists(public_path($buku->cover_buku))) {
                @unlink(public_path($buku->cover_buku));
            }
            $file = $request->file('cover_buku');
            $filename = 'cover_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('covers'), $filename);
            $data['cover_buku'] = 'covers/' . $filename;
        }

        $buku->update($data);

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function bukuDestroy($id)
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }

        $buku = Buku::findOrFail($id);
        if ($buku->file_pdf && file_exists(public_path($buku->file_pdf))) {
            @unlink(public_path($buku->file_pdf));
        }
        if ($buku->cover_buku && file_exists(public_path($buku->cover_buku))) {
            @unlink(public_path($buku->cover_buku));
        }
        $buku->delete();

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil dihapus.');
    }

    public function bukuStore(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }

        $request->validate([
            'isbn' => 'required|unique:buku,isbn',
            'judul_buku' => 'required|string|max:150',
            'pengarang' => 'required|string|max:100',
            'stok_fisik' => 'required|integer|min:0',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('ebooks'), $filename);
            $pdfPath = 'ebooks/' . $filename;
        }

        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $file = $request->file('cover_buku');
            $filename = 'cover_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('covers'), $filename);
            $coverPath = 'covers/' . $filename;
        }

        Buku::create([
            'isbn' => $request->isbn,
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'stok_fisik' => $request->stok_fisik,
            'file_pdf' => $pdfPath,
            'cover_buku' => $coverPath,
        ]);

        return redirect()->route('admin.buku')->with('success', 'Buku baru, cover & E-Book PDF berhasil diunggah.');
    }

    public function userCreate()
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }
        $users = User::all();
        return view('dashboard.admin.admin-users', compact('user', 'users'));
    }

    public function userStore(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Admin') {
            abort(403);
        }

        $request->validate([
            'username' => 'required|unique:users,username',
            'nama_user' => 'required|string|max:100',
            'password' => 'required|min:6',
            'role' => 'required|in:Admin,Petugas,Siswa',
        ]);

        User::create([
            'username' => $request->username,
            'nama_user' => $request->nama_user,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function petugasIndex(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Petugas' && $user->role !== 'Admin') {
            abort(403);
        }

        $search = $request->input('search');
        $peminjamen = Peminjaman::with(['siswa', 'details.buku'])
            ->when($search, function ($query, $search) {
                $query->where('kode_transaksi', 'like', "%{$search}%")
                      ->orWhereHas('siswa', function ($q) use ($search) {
                          $q->where('nama_user', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->get();

        $siswas = User::where('role', 'Siswa')->get();
        $bukus = Buku::where('stok_fisik', '>', 0)->get();

        return view('dashboard.petugas.petugas-sirkulasi', compact('user', 'peminjamen', 'siswas', 'bukus', 'search'));
    }

    public function petugasStorePeminjaman(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Petugas' && $user->role !== 'Admin') {
            abort(403);
        }

        $request->validate([
            'id_siswa' => 'required|exists:users,id_user',
            'buku_ids' => 'required|array|min:1',
            'buku_ids.*' => 'exists:buku,id_buku',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:today',
        ]);

        foreach ($request->buku_ids as $idBuku) {
            $buku = Buku::findOrFail($idBuku);
            if ($buku->stok_fisik < 1) {
                return back()->withErrors(['stok' => 'Stok fisik untuk buku "' . $buku->judul_buku . '" tidak mencukupi.']);
            }
        }

        $peminjaman = Peminjaman::create([
            'kode_transaksi' => 'TRX-LIB-' . date('Ymd') . '-' . rand(100, 999),
            'id_siswa' => $request->id_siswa,
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
        ]);

        foreach ($request->buku_ids as $idBuku) {
            $buku = Buku::findOrFail($idBuku);
            $buku->decrement('stok_fisik', 1);

            $peminjaman->details()->create([
                'id_buku' => $buku->id_buku,
                'jumlah_pinjam' => 1,
            ]);
        }

        return redirect()->route('petugas.sirkulasi')->with('success', 'Transaksi multi-buku berhasil dicatat & stok berkurang otomatis.');
    }

    public function petugasBukuCreate()
    {
        $user = auth()->user();
        if ($user->role !== 'Petugas' && $user->role !== 'Admin') {
            abort(403);
        }
        $bukus = Buku::all();
        return view('dashboard.petugas.petugas-buku', compact('user', 'bukus'));
    }

    public function petugasBukuStore(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Petugas' && $user->role !== 'Admin') {
            abort(403);
        }

        $request->validate([
            'isbn' => 'required|unique:buku,isbn',
            'judul_buku' => 'required|string|max:150',
            'pengarang' => 'required|string|max:100',
            'stok_fisik' => 'required|integer|min:0',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('ebooks'), $filename);
            $pdfPath = 'ebooks/' . $filename;
        }

        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $file = $request->file('cover_buku');
            $filename = 'cover_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('covers'), $filename);
            $coverPath = 'covers/' . $filename;
        }

        Buku::create([
            'isbn' => $request->isbn,
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'stok_fisik' => $request->stok_fisik,
            'file_pdf' => $pdfPath,
            'cover_buku' => $coverPath,
        ]);

        return redirect()->route('petugas.buku')->with('success', 'Buku baru, cover & E-Book PDF berhasil ditambahkan.');
    }

    public function cetakKartu($id)
    {
        $user = auth()->user();
        $peminjaman = Peminjaman::with(['siswa', 'details.buku'])->findOrFail($id);

        if ($user->role === 'Siswa' && $peminjaman->id_siswa !== $user->id_user) {
            abort(403);
        }

        return view('dashboard.cetak-kartu', compact('peminjaman'));
    }

    public function siswaIndex(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Siswa') {
            abort(403);
        }
        $bukus = Buku::all();
        $peminjamen = Peminjaman::with(['siswa', 'details.buku'])->where('id_siswa', $user->id_user)->latest()->get();
        return view('dashboard.siswa.siswa-katalog', compact('user', 'bukus', 'peminjamen'));
    }

    public function siswaRiwayat(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'Siswa') {
            abort(403);
        }
        $peminjamen = Peminjaman::with(['siswa', 'details.buku'])->where('id_siswa', $user->id_user)->latest()->get();
        return view('dashboard.siswa.siswa-riwayat', compact('user', 'peminjamen'));
    }
}
