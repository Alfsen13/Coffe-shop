@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Riwayat Produk yang Sudah Diverifikasi</h2>
    <div class="mb-3">
        <a href="{{ route('admin.produk.terverifikasi.cetak') }}" target="_blank" class="btn btn-success">
            <i class="bi bi-printer"></i> Cetak Laporan
        </a>
    </div>

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
</div>
@endsection
