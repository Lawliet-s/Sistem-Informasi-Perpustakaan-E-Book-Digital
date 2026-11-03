<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Peminjaman · {{ $peminjaman->kode_transaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #000;
            margin: 0;
            padding: 20px;
        }
        .card {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            border: 2px solid #333;
            padding: 25px;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h2 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 13px; color: #555; }
        .info-group { margin-bottom: 15px; font-size: 14px; }
        .info-group label { font-weight: bold; display: inline-block; width: 160px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
            font-size: 13px;
        }
        th { background: #f0f0f0; }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            font-size: 13px;
        }
        .sign { text-align: center; width: 200px; }
        .sign div { height: 60px; }
        .no-print {
            text-align: center;
            margin-bottom: 25px;
        }
        .btn-print {
            background: #A65E2E;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            .card { border: none; max-width: 100%; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan sebagai PDF</button>
        <p style="font-size: 12px; color: #666; margin-top: 8px;">Jika jendela cetak tidak muncul otomatis, klik tombol di atas.</p>
    </div>

    <div class="card">
        <div class="header">
            <h2>SMK-LIB · Kartu Bukti Peminjaman</h2>
            <p>Sistem Informasi Perpustakaan & E-Book Digital (Paket Advanced 7)</p>
        </div>

        <div class="info-group">
            <div><label>Kode Transaksi:</label> <span>{{ $peminjaman->kode_transaksi }}</span></div>
            <div style="margin-top: 6px;"><label>Nama Peminjam:</label> <span>{{ $peminjaman->siswa->nama_user ?? '-' }} (@ {{ $peminjaman->siswa->username ?? '-' }})</span></div>
            <div style="margin-top: 6px;"><label>Tanggal Pinjam:</label> <span>{{ $peminjaman->tgl_pinjam }}</span></div>
            <div style="margin-top: 6px;"><label>Rencana Kembali:</label> <span>{{ $peminjaman->tgl_kembali_rencana }}</span></div>
            <div style="margin-top: 6px;"><label>Status Pengembalian:</label> <span>{{ $peminjaman->tgl_kembali_real ? 'Sudah Dikembalikan (' . $peminjaman->tgl_kembali_real . ')' : 'Masih Dipinjam' }}</span></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku / E-Book</th>
                    <th>Pengarang</th>
                    <th>Jumlah Eksemplar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman->details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->buku->judul_buku ?? '-' }}</td>
                        <td>{{ $detail->buku->pengarang ?? '-' }}</td>
                        <td>{{ $detail->jumlah_pinjam }} eks</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <div>
                <p><strong>Ketentuan Peminjaman:</strong></p>
                <p style="font-size: 11px; color: #444; line-height: 1.4;">
                    1. Keterlambatan dikenakan denda Rp 1.000 / hari.<br>
                    2. Kartu ini wajib dibawa saat pengembalian buku fisik.
                </p>
            </div>
            <div class="sign">
                <p>Petugas Perpustakaan</p>
                <div></div>
                <p><strong>( _______________ )</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
