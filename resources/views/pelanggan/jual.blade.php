@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Jual Perangkat Saya</h2>
    <form method="POST" action="{{ route('pelanggan.jual.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Perangkat</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-select">
                <option value="bekas">Bekas</option>
                <option value="sparepart">Sparepart</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Spesifikasi & Kondisi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label>Harga yang Diinginkan</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto Produk</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Jual Sekarang</button>
    </form>
</div>
@endsection
