@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Verifikasi Produk</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>
                        <form action="{{ route('admin.produk.setujui', $item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">Verifikasi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
