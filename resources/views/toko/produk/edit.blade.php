@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form method="POST" action="{{ route('toko.produk.update', $produk->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-select">
                <option value="baru" {{ $produk->kategori == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="bekas" {{ $produk->kategori == 'bekas' ? 'selected' : '' }}>Bekas</option>
                <option value="sparepart" {{ $produk->kategori == 'sparepart' ? 'selected' : '' }}>Sparepart</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>
        <div class="mb-3">
            <label>Foto Produk (Opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection