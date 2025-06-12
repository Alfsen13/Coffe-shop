@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Manajemen Pengguna</h2>
    <table class="table">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.update-role', $user->id) }}">
                            @csrf @method('PUT')
                            <select name="role" class="form-select" onchange="this.form.submit()">
                                @foreach(['teknisi', 'toko', 'pelanggan'] as $r)
                                    <option value="{{ $r }}" {{ $user->role == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td><small>{{ $user->created_at->diffForHumans() }}</small></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
