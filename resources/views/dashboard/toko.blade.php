@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Toko</h1>
    <div class="alert alert-primary">
        Halo <strong>{{ Auth::user()->name }}</strong>, ini adalah dashboard untuk Toko/Distributor.
    </div>
    <p>Kelola produk, cek pesanan pelanggan, dan update stok perangkat kamu.</p>
    <a href="#" class="btn btn-success">Tambah Produk Baru</a>
</div>
@endsection
