@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Daftar Produk</h2>
    <a href="{{ route('toko.produk.create') }}" class="btn btn-success mb-3">Tambah Produk Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>
                        <a href="{{ route('toko.produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('toko.produk.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection