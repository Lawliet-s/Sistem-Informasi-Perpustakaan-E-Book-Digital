<a id="top"></a>

# SMK-LIB
### Paket Advanced 7 · Uji Kompetensi Keahlian RPL

**Sistem Informasi Perpustakaan & E-Book Digital**  
*Enterprise & Fullstack Architecture — Studi Kasus*

---

<aside>
<strong>NAVIGASI</strong>

- [Ringkasan](#ringkasan)
- [Skenario Sistem](#skenario-sistem)
- [Role Pengguna](#role-pengguna)
- [Rancangan Database](#rancangan-database)
  - [users](#1-users)
  - [buku](#2-buku)
  - [peminjaman](#3-peminjaman)
  - [detail_peminjaman](#4-detail_peminjaman)
- [Skenario Pengujian](#skenario-pengujian)
- [Catatan untuk AI](#catatan-untuk-ai)
</aside>

## Ringkasan

| Informasi | Detail |
|---|---|
| Paket | Advanced 7 |
| Mata pelajaran | RPL Enterprise / Software Architecture |
| Studi kasus | E-Library |
| Nama sistem | SMK-LIB |
| Waktu pengerjaan | 240 menit (4 jam) |
| Database | `db_perpus_rpl` |

## Skenario Sistem

Perpustakaan pusat sekolah membutuhkan aplikasi manajemen sirkulasi buku dan perpustakaan digital berbasis web.

Sistem mencakup tiga jenis pengguna: Admin/Pustakawan, Petugas Sirkulasi, dan Siswa/Anggota. Fitur utamanya meliputi pengelolaan katalog, proses peminjaman dan pengembalian buku fisik, perhitungan denda keterlambatan, booking peminjaman, serta pembacaan e-book PDF langsung melalui web.

## Role Pengguna

| Role | Tanggung jawab |
|---|---|
| **Admin / Pustakawan** | Mengelola katalog buku, kategori, penerbit, dan persetujuan pinjaman. |
| **Petugas Sirkulasi** | Memproses transaksi peminjaman dan pengembalian buku fisik serta menghitung denda keterlambatan. |
| **Siswa / Anggota** | Mencari buku, melakukan booking peminjaman fisik, dan membaca e-book PDF melalui web. |

## Rancangan Database

Database yang disebutkan dalam dokumen adalah `db_perpus_rpl`.

> **Catatan sumber:** Judul dokumen menyebut rancangan 5 tabel, tetapi bagian yang terlihat hanya merinci 4 tabel. Dokumen ini tidak menambahkan tabel kelima karena strukturnya tidak tersedia pada sumber.

### 1. `users`

**Fungsi:** Menyimpan data pengguna dengan beberapa role.

| Field | Tipe data | Keterangan |
|---|---|---|
| `id_user` | `INT(11)` | Primary Key, Auto Increment |
| `username` | `VARCHAR(50)` | Unique; identitas login / NIS / NIP |
| `password` | `VARCHAR(255)` | Encrypted menggunakan `password_hash` Bcrypt |
| `nama_user` | `VARCHAR(100)` | Nama lengkap pengguna |
| `role` | `ENUM` | Pilihan: `Admin`, `Petugas`, `Siswa` |

### 2. `buku`

**Fungsi:** Menyimpan data master buku dan e-book.

| Field | Tipe data | Keterangan |
|---|---|---|
| `id_buku` | `INT(11)` | Primary Key, Auto Increment |
| `isbn` | `VARCHAR(20)` | Unique; contoh: `978-602-8519-93-9` |
| `judul_buku` | `VARCHAR(150)` | Judul buku / e-book |
| `pengarang` | `VARCHAR(100)` | Nama penulis / pengarang |
| `stok_fisik` | `INT(5)` | Jumlah eksemplar fisik tersedia |
| `file_pdf` | `VARCHAR(255)` | Nama file e-book PDF yang diunggah; bisa `NULL` |
| `cover_buku` | `VARCHAR(255)` | Nama file gambar cover buku |

### 3. `peminjaman`

**Fungsi:** Menyimpan data header transaksi peminjaman.

| Field | Tipe data | Keterangan |
|---|---|---|
| `id_peminjaman` | `INT(11)` | Primary Key, Auto Increment |
| `kode_transaksi` | `VARCHAR(30)` | Unique; contoh: `TRX-LIB-2026-01` |
| `id_siswa` | `INT(11)` | Foreign Key ke `users.id_user` |
| `tgl_pinjam` | `DATE` | Tanggal mulai pinjam |
| `tgl_kembali_rencana` | `DATE` | Rencana tanggal pengembalian |
| `tgl_kembali_real` | `DATE` | Tanggal realisasi pengembalian; bisa `NULL` |
| `denda` | `INT(11)` | Denda keterlambatan: Rp1.000 per hari |

### 4. `detail_peminjaman`

**Fungsi:** Menjadi junction table untuk relasi buku yang dipinjam (many-to-many).

| Field | Tipe data | Keterangan |
|---|---|---|
| `id_detail` | `INT(11)` | Primary Key, Auto Increment |
| `id_peminjaman` | `INT(11)` | Foreign Key ke `peminjaman.id_peminjaman` |
| `id_buku` | `INT(11)` | Foreign Key ke `buku.id_buku` |
| `jumlah_pinjam` | `INT(3)` | Jumlah eksemplar yang dipinjam |

## Skenario Pengujian

| No. | Fitur advanced | Skenario pengujian | Hasil yang diharapkan |
|---:|---|---|---|
| 1 | **PDF Reader Viewer** | Siswa mengeklik “Baca E-Book”. | File PDF e-book tampil di web viewer. |
| 2 | **Multi-Buku Pinjam** | Petugas memasukkan 2 buku dalam 1 transaksi. | Data tersimpan di `detail_peminjaman`. |
| 3 | **Auto Trigger Stok** | Transaksi peminjaman disahkan. | Stok fisik buku berkurang otomatis di database. |
| 4 | **Kalkulasi Denda** | Pengembalian terlambat 3 hari. | Sistem menghitung denda Rp3.000 secara otomatis. |
| 5 | **Export Kartu Pinjam PDF** | Pengguna mengeklik “Cetak Kartu Peminjaman”. | File PDF Kartu Bebas Perpus / Pinjam diunduh. |

### Checklist hasil pengujian

| No. | Fitur | Status |
|---:|---|---|
| 1 | PDF Reader Viewer | [ ] Pass / [ ] Fail |
| 2 | Multi-Buku Pinjam | [ ] Pass / [ ] Fail |
| 3 | Auto Trigger Stok | [ ] Pass / [ ] Fail |
| 4 | Kalkulasi Denda | [ ] Pass / [ ] Fail |
| 5 | Export Kartu Pinjam PDF | [ ] Pass / [ ] Fail |

## Catatan untuk AI

Gunakan dokumen ini sebagai sumber utama ketika menjawab pertanyaan atau membantu pengerjaan proyek SMK-LIB.

1. Pertahankan nama tabel, nama field, tipe data, relasi, role, dan istilah fitur seperti yang tertulis di dokumen.
2. Jangan mengarang detail yang tidak tersedia di sumber. Jika informasi belum disebutkan, nyatakan bahwa dokumen tidak menjelaskannya.
3. Bedakan dengan jelas antara **ketentuan dari dokumen** dan **saran atau rancangan tambahan**.
4. Jangan menganggap tabel kelima sudah diketahui. Sumber hanya merinci empat tabel.
5. Untuk contoh implementasi, sesuaikan pembahasan dengan studi kasus perpustakaan sekolah dan kebutuhan tiga role pengguna.

---

[↑ Kembali ke atas](#top)
