@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>
    <div class="alert alert-info">
        Selamat datang Admin <strong>{{ Auth::user()->name }}</strong> di sistem UpgradeHub.
    </div>
    <ul class="list-group">
        <li class="list-group-item">Kelola Pengguna</li>
        <li class="list-group-item">Kelola Teknisi & Toko</li>
        <li class="list-group-item">Laporan Sistem</li>
    </ul>
</div>
@endsection
