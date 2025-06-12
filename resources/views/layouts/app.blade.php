<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UpgradeHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand text-white" href="{{ route('landing') }}">UpgradeHub</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRole" aria-controls="navbarRole" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
        <div class="collapse navbar-collapse" id="navbarRole">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::user()->role === 'toko')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('toko.produk.*') ? 'active' : '' }}" href="{{ route('toko.produk.index') }}">Kelola Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('toko.laporan') ? 'active' : '' }}" href="{{ route('toko.laporan') }}">Laporan Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('toko.ulasan') ? 'active' : '' }}" href="{{ route('toko.ulasan') }}">Ulasan Pembeli</a>
                    </li>
                @elseif (Auth::user()->role === 'pelanggan')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.produk') ? 'active' : '' }}" href="{{ route('pelanggan.produk') }}">Lihat Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.jual') ? 'active' : '' }}" href="{{ route('pelanggan.jual') }}">Jual Perangkat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.servis') ? 'active' : '' }}" href="{{ route('pelanggan.servis') }}">Panggil Teknisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.upgrade') ? 'active' : '' }}" href="{{ route('pelanggan.upgrade') }}">Rekomendasi Upgrade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.riwayat') ? 'active' : '' }}" href="{{ route('pelanggan.riwayat') }}">Riwayat</a>
                    </li>
                @elseif (Auth::user()->role === 'teknisi')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teknisi.servis.index') ? 'active' : '' }}" href="{{ route('teknisi.servis.index') }}">Permintaan Servis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teknisi.servis.show') ? 'active' : '' }}" href="#">Lihat Detail</a>
                    </li>
                    

                @elseif (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Manajemen Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.produk.verifikasi') ? 'active' : '' }}" href="{{ route('admin.produk.verifikasi') }}">Verifikasi Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.monitoring') ? 'active' : '' }}" href="{{ route('admin.monitoring') }}">Monitoring</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.produk.terverifikasi') ? 'active' : '' }}" href="{{ route('admin.produk.terverifikasi') }}">Riwayat Verifikasi</a>
                    </li>
                @endif
            </ul>

            <div class="d-flex align-items-center">
                <span class="navbar-text text-white me-3">Hai, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
        @endauth
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
