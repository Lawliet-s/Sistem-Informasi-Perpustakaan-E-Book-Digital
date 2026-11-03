<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'isbn',
        'judul_buku',
        'pengarang',
        'stok_fisik',
        'file_pdf',
        'cover_buku',
    ];

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_buku', 'id_buku');
    }
}
