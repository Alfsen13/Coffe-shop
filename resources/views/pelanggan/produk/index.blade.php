@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Produk Marketplace</h2>
    <div class="row">
        @foreach ($produk as $item)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <p>Kategori: {{ ucfirst($item->kategori) }}</p>
                        <p>Harga: <strong>Rp {{ number_format($item->harga) }}</strong></p>
                        <p>Stok: {{ $item->stok }}</p>
                        <a href="{{ route('pelanggan.produk.detail', $item->id) }}" class="btn btn-primary w-100 {{ $item->stok == 0 ? 'disabled' : '' }}">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection