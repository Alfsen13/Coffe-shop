@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Monitoring Sistem</h2>
        <a href="{{ route('admin.monitoring.cetak') }}" class="btn btn-sm btn-primary">Cetak Monitoring</a>
    </div>

    <div class="mb-4">
        <h4>📦 Transaksi Terbaru</h4>
        <table class="table table-bordered table-sm">
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
                        <td><span class="badge bg-{{ $trx->status === 'selesai' ? 'success' : ($trx->status === 'dikirim' ? 'warning' : 'secondary') }}">{{ ucfirst($trx->status) }}</span></td>
                        <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <h4>🛠️ Servis Terbaru</h4>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Jenis Servis</th>
                    <th>Lokasi</th>
                    <th>Jadwal</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servis as $srv)
                    <tr>
                        <td>{{ $srv->jenis }}</td>
                        <td>{{ $srv->lokasi }}</td>
                        <td>{{ \Carbon\Carbon::parse($srv->jadwal)->format('d M Y H:i') }}</td>
                        <td>{{ $srv->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <h4>🌟 Ulasan Terbaru</h4>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ulasan as $uls)
                    <tr>
                        <td>{{ $uls->produk->nama }}</td>
                        <td>{{ $uls->rating }} / 5</td>
                        <td>{{ $uls->komentar ?? '-' }}</td>
                        <td>{{ $uls->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
