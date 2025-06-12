<!DOCTYPE html>
<html>
<head>
    <title>Cetak Riwayat Verifikasi Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center mb-4">Laporan Produk yang Sudah Diverifikasi</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Tanggal Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ ucfirst($item->kategori) }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>{{ $item->updated_at->format('d M Y - H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="no-print mt-3 text-center">
        <button onclick="window.print()" class="btn btn-primary">Cetak Sekarang</button>
    </div>
</div>
</body>
</html>
