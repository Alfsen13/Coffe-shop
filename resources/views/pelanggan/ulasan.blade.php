@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Beri Ulasan untuk: {{ $produk->nama }}</h2>

    <form method="POST" action="{{ route('pelanggan.produk.ulasan', ['id' => $produk->id, 'trx' => $trx->id]) }}">
        @csrf

        {{-- Kirim ID Transaksi --}}
        <input type="hidden" name="transaksi_id" value="{{ $trx->id }}">

        <div class="mb-3">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label for="komentar">Komentar</label>
            <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis kesan kamu di sini..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
