@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Manajemen Pengguna</h2>

    {{-- Tambah User --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Tambah Pengguna Baru
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="" disabled selected>Pilih Role</option>
                            @foreach(['admin', 'teknisi', 'toko', 'pelanggan'] as $role)
                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar User --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            Daftar Pengguna
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="{{ $user->role == 'admin' ? 'table-secondary' : '' }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                @if ($user->id != auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-muted">Akun Anda</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
