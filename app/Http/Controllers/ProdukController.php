<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('toko_id', auth()->id())->get();
        return view('toko.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('toko.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048'
        ]);
        // Simulasi Estimasi Harga (bisa lebih kompleks)
        $estimasiHarga = $request->harga * 0.9;

        // Simulasi Hash SHA-256 dari data penting
        $dataHash = $request->nama . '|' . $request->kategori . '|' . $estimasiHarga;
        $hash = hash('sha256', $dataHash);

        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->kategori = $request->kategori;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->toko_id = auth()->id();
        $produk->hash_harga = $hash;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('produk', 'public');
            $produk->foto = $fotoPath;
        }

        $produk->save();

        return redirect()->route('toko.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::where('id', $id)->where('toko_id', auth()->id())->firstOrFail();
        return view('toko.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->where('toko_id', auth()->id())->firstOrFail();

        $produk->nama = $request->nama;
        $produk->kategori = $request->kategori;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('produk', 'public');
            $produk->foto = $fotoPath;
        }

        $produk->save();

        return redirect()->route('toko.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->where('toko_id', auth()->id())->firstOrFail();
        $produk->delete();

        return redirect()->route('toko.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}