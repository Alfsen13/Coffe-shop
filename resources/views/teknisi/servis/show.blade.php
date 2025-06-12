@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Detail Servis</h2>
    <div class="mb-3">
        <strong>Pelanggan:</strong> {{ $servis->pelanggan->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>Jenis Servis:</strong> {{ $servis->jenis }}
    </div>
    <div class="mb-3">
        <strong>Lokasi:</strong> {{ $servis->lokasi }}
    </div>
    <div class="mb-3">
        <strong>Jadwal Kunjungan:</strong> {{ \Carbon\Carbon::parse($servis->jadwal)->format('d M Y H:i') }}
    </div>
    <div class="mb-3">
        <strong>Status Saat Ini:</strong> {{ ucfirst($servis->status) }}
    </div>

    <form method="POST" action="{{ route('teknisi.servis.update', $servis->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status">Perbarui Status</label>
            <select name="status" class="form-select">
                <option value="menunggu" {{ $servis->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dijadwalkan" {{ $servis->status == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                <option value="selesai" {{ $servis->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan">Catatan Teknisi (Opsional)</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $servis->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
