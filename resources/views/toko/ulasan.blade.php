@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Ulasan Pembeli</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Pembeli</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ulasan as $u)
                <tr>
                    <td>{{ $u->produk->nama }}</td>
                    <td>{{ $u->rating }}/5</td>
                    <td>{{ $u->komentar }}</td>
                    <td>{{ $u->pembeli->name }}</td>
                    <td>{{ $u->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection