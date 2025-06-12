@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Teknisi</h1>
    <div class="alert alert-warning">
        Halo Teknisi <strong>{{ Auth::user()->name }}</strong>! Siap menyelesaikan tugas hari ini?
    </div>
    <ul class="list-group">
        <li class="list-group-item">Daftar permintaan servis</li>
        <li class="list-group-item">Riwayat pekerjaan</li>
    </ul>
</div>
@endsection
