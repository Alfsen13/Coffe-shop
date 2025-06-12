@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Riwayat Transaksi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $trx)
                <tr>
                    <td>{{ $trx->produk->nama }}</td>
                    <td>Rp {{ number_format($trx->produk->harga) }}</td>
                    <td>{{ $trx->jumlah }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $trx->status === 'diproses' ? 'secondary' : 
                            ($trx->status === 'dikirim' ? 'warning' : 'success') 
                        }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>
                    <td>{{ $trx->created_at->format('d M Y') }}</td>
                    <td>
                        @php
                            $selesai = $trx->status === 'selesai';

                            $sudahUlas = \App\Models\Ulasan::where('transaksi_id', $trx->id)->exists();
                        @endphp

                        @if ($selesai && !$sudahUlas)
                            <a href="{{ route('pelanggan.ulasan.form', ['id' => $trx->produk->id, 'trx' => $trx->id]) }}" class="btn btn-sm btn-warning">Ulas Produk</a>
                        @elseif ($sudahUlas)
                            <span class="text-muted">Sudah Diulas</span>
                        @else
                            <span class="text-muted">Menunggu Selesai</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
