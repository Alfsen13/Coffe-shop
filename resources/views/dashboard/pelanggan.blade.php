@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Pelanggan</h1>
    <div class="alert alert-success">
        Halo <strong>{{ Auth::user()->name }}</strong>, selamat datang di UpgradeHub!
    </div>
    <p>Kamu bisa cek daftar perangkat, permintaan upgrade, dan status servis di sini.</p>
    <a href="#" class="btn btn-primary">Mulai Cari Perangkat</a>
</div>
@endsection
