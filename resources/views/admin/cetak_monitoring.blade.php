<!DOCTYPE html>
<html>
<head>
    <title>Cetak Monitoring</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Monitoring Sistem UpgradeHub</h2>

    <h4>Transaksi Terbaru</h4>
    <table>
        <thead>
            <tr>
                <th>Pembeli</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $trx)
                <tr>
                    <td>{{ $trx->pembeli->name }}</td>
                    <td>{{ $trx->produk->nama }}</td>
                    <td>{{ ucfirst($trx->status) }}</td>
                    <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Servis Terbaru</h4>
    <table>
        <thead>
            <tr>
                <th>Jenis Servis</th>
                <th>Lokasi</th>
                <th>Jadwal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servis as $srv)
                <tr>
                    <td>{{ $srv->jenis }}</td>
                    <td>{{ $srv->lokasi }}</td>
                    <td>{{ \Carbon\Carbon::parse($srv->jadwal)->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Ulasan Terbaru</h4>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Rating</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ulasan as $uls)
                <tr>
                    <td>{{ $uls->produk->nama }}</td>
                    <td>{{ $uls->rating }}</td>
                    <td>{{ $uls->komentar ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>
