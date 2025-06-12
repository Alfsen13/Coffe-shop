@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Daftar Permintaan Servis</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Jenis Servis</th>
                <th>Lokasi</th>
                <th>Jadwal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servis as $s)
            <tr>
                <td>{{ $s->pelanggan->name ?? '-' }}</td>
                <td>{{ $s->jenis }}</td>
                <td>{{ $s->lokasi }}</td>
                <td>{{ \Carbon\Carbon::parse($s->jadwal)->format('d M Y H:i') }}</td>
                <td>
                    <span class="badge bg-{{ $s->status == 'selesai' ? 'success' : ($s->status == 'dijadwalkan' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($s->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('teknisi.servis.show', $s->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
