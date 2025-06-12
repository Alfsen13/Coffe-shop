@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Laporan Penjualan</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Pembeli</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $trx)
                <tr>
                    <td>{{ $trx->produk->nama }}</td>
                    <td>{{ $trx->pembeli->name }}</td>
                    <td>{{ $trx->created_at->format('d M Y') }}</td>
                    <td>{{ $trx->jumlah }}</td>
                    <td>
                        <form method="POST" action="{{ route('toko.laporan.update', $trx->id) }}" class="d-flex align-items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm me-2">
                                <option value="diproses" {{ $trx->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="dikirim" {{ $trx->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $trx->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
