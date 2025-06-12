@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $produk->nama }}</h2>
            <p><strong>Kategori:</strong> {{ ucfirst($produk->kategori) }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($produk->harga) }}</p>
            <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
            <p><strong>Stok Tersedia:</strong> {{ $produk->stok }}</p>
                @if ($produk->stok > 0)
                    @if ($produk->toko_id === auth()->id())
                        <div class="alert alert-info mt-3">
                            Ini adalah produk milikmu sendiri. Kamu tidak bisa membelinya.
                        </div>
                    @else
                        <form method="POST" action="{{ route('pelanggan.produk.beli', $produk->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Alamat Pengiriman</label>
                                <textarea name="alamat_pengiriman" class="form-control" rows="3" placeholder="Tulis alamat lengkap kamu..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Beli Sekarang</button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-warning mt-3">
                        Stok habis, produk tidak tersedia.
                    </div>
                @endif
        </div>
    </div>
</div>
@endsection
