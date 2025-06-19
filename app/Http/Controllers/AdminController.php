<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Servis;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,teknisi,toko,pelanggan'
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role pengguna diperbarui.');
    }

    public function verifikasiProduk()
    {
        $produk = Produk::where('hash_harga', '!=', null)->where('verifikasi', false)->get();
        return view('admin.produk_verifikasi', compact('produk'));
    }

    public function approveProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->verifikasi = true;
        $produk->save();

        return back()->with('success', 'Produk telah diverifikasi.');
    }

    public function monitoring()
    {
        $transaksi = Transaksi::with('produk', 'pembeli')->latest()->take(10)->get();
        $servis = Servis::latest()->take(10)->get();
        $ulasan = Ulasan::with('produk')->latest()->take(10)->get();

        return view('admin.monitoring', compact('transaksi', 'servis', 'ulasan'));
    }

    public function produkTerverifikasi()
    {
        $produk = Produk::where('verifikasi', true)->get();
        return view('admin.produk_terverifikasi', compact('produk'));
    }

    public function cetakProdukTerverifikasi()
    {
        $produk = Produk::where('verifikasi', true)->get();
        return view('admin.cetak_produk_terverifikasi', compact('produk'));
    }

    public function cetakMonitoring()
    {
        $transaksi = Transaksi::with('produk', 'pembeli')->latest()->take(10)->get();
        $servis = Servis::latest()->take(10)->get();
        $ulasan = Ulasan::with('produk')->latest()->take(10)->get();

        return view('admin.cetak_monitoring', compact('transaksi', 'servis', 'ulasan'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teknisi,toko,pelanggan'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Jangan hapus diri sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }

}
