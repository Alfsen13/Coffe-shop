@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Form Permintaan Servis Teknisi</h2>
    <form method="POST" action="{{ route('pelanggan.servis.submit') }}">
        @csrf
        <div class="mb-3">
            <label>Jenis Servis</label>
            <select name="jenis" class="form-select" required>
                <option value="perbaikan">Perbaikan</option>
                <option value="pengecekan">Pengecekan</option>
                <option value="upgrade">Upgrade</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jadwal Kunjungan</label>
            <input type="datetime-local" name="jadwal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Kirim Permintaan</button>
    </form>
</div>
@endsection
