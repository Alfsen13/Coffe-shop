@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Rekomendasi Upgrade</h2>

    <form method="POST" action="{{ route('pelanggan.upgrade.result') }}">
        @csrf

        <div class="mb-3">
            <label>RAM Saat Ini</label>
            <select name="ram" class="form-select" required>
                <option value="2GB">2GB</option>
                <option value="4GB">4GB</option>
                <option value="8GB">8GB</option>
                <option value="16GB">16GB</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Penyimpanan</label>
            <select name="penyimpanan" class="form-select" required>
                <option value="HDD">HDD</option>
                <option value="SSD">SSD</option>
                <option value="Hybrid">Hybrid</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Prosesor</label>
            <select name="prosesor" class="form-select" required>
                <option value="Intel i3">Intel i3</option>
                <option value="Intel i5">Intel i5</option>
                <option value="Ryzen 3">Ryzen 3</option>
                <option value="Ryzen 5">Ryzen 5</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Dapatkan Rekomendasi</button>
    </form>

    @isset($rekomendasi)
    <div class="mt-4">
        <h5>Hasil Rekomendasi:</h5>
        @if (count($rekomendasi) > 0)
            <ul class="list-group">
                @foreach ($rekomendasi as $item)
                    <li class="list-group-item">{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info mt-2">Spesifikasimu sudah cukup baik, tidak ada rekomendasi upgrade 😎</div>
        @endif
    </div>
    @endisset
</div>
@endsection
