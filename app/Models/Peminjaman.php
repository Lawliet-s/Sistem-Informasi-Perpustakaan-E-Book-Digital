<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'kode_transaksi',
        'id_siswa',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'tgl_kembali_real',
        'denda',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id_user');
    }

    public function details()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
