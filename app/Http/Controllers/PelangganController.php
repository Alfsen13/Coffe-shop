<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\Servis;
use Illuminate\Support\Str;

class PelangganController extends Controller
{
    public function dashboard()
    {
        return view('pelanggan.dashboard');
    }

    public function listProduk()
    {
        $produk = Produk::where('stok', '>', 0)
                        ->where('verifikasi', true) // hanya tampil jika sudah diverifikasi
                        ->get();

        return view('pelanggan.produk.index', compact('produk'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pelanggan.produk.detail', compact('produk'));
    }

    public function formUlasan($id, $trx)
    {
        $produk = Produk::findOrFail($id);

        // Pastikan transaksinya benar & milik user
        $transaksi = Transaksi::where('id', $trx)
            ->where('produk_id', $id)
            ->where('pembeli_id', auth()->id())
            ->where('status', 'selesai')
            ->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak valid atau belum selesai.');
        }

        // Cek apakah transaksi ini sudah diberi ulasan
        $sudahUlas = Ulasan::where('transaksi_id', $transaksi->id)->exists();

        if ($sudahUlas) {
            return redirect()->back()->with('info', 'Kamu sudah memberi ulasan untuk transaksi ini.');
        }

        return view('pelanggan.ulasan', [
            'produk' => $produk,
            'trx' => $transaksi
        ]);
    }


    public function beriUlasan(Request $request, $id, $trxId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        // Validasi transaksi
        $trx = Transaksi::where('id', $trxId)
            ->where('produk_id', $id)
            ->where('pembeli_id', auth()->id())
            ->where('status', 'selesai')
            ->first();

        if (!$trx) {
            return back()->with('error', 'Transaksi tidak valid atau belum selesai.');
        }

        $sudahUlas = Ulasan::where('transaksi_id', $trx->id)->exists();
        if ($sudahUlas) {
            return back()->with('info', 'Kamu sudah memberi ulasan untuk transaksi ini.');
        }

        Ulasan::create([
            'produk_id' => $id,
            'pembeli_id' => auth()->id(),
            'transaksi_id' => $trx->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('pelanggan.riwayat')->with('success', 'Ulasan berhasil dikirim.');
    }



    public function beli(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'alamat_pengiriman' => 'required|string|max:255',
        ]);

        $produk = Produk::findOrFail($id);

        // Cegah beli produk sendiri
        if ($produk->toko_id === auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa membeli produk milikmu sendiri.');
        }
        // Validasi stok cukup
        if ($produk->stok < $request->jumlah) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Buat transaksi
        Transaksi::create([
            'produk_id' => $produk->id,
            'pembeli_id' => auth()->id(),
            'toko_id' => $produk->toko_id,
            'jumlah' => $request->jumlah,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'status' => 'diproses',
        ]);

        // Kurangi stok
        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('pelanggan.riwayat')->with('success', 'Pembelian berhasil.');
    }


    public function jualForm()
    {
        return view('pelanggan.jual');
    }

    public function jualSubmit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048', // max 2MB
        ]);

        $estimasiHarga = $request->harga * 0.9;
        $dataHash = $request->nama . '|' . $request->kategori . '|' . $estimasiHarga;
        $hash = hash('sha256', $dataHash);

        $produk = new Produk();
        $produk->toko_id = auth()->id(); // dianggap user individu
        $produk->nama = $request->nama;
        $produk->kategori = $request->kategori;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = 1;
        $produk->hash_harga = $hash;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('produk', 'public');
            $produk->foto = $fotoPath;
        }

        $produk->save();

        return redirect()->route('pelanggan.produk')->with('success', 'Perangkat berhasil dijual.');
    }


    public function upgradeForm()
    {
        return view('pelanggan.upgrade');
    }

    public function upgradeResult(Request $request)
    {
        $saran = [];

        if ($request->ram == '2GB' || $request->ram == '4GB') {
            $saran[] = 'Upgrade RAM minimal ke 8GB';
        }

        if ($request->penyimpanan == 'HDD') {
            $saran[] = 'Ganti HDD ke SSD 256GB atau lebih';
        }

        if (Str::contains(strtolower($request->prosesor), 'i3') || Str::contains(strtolower($request->prosesor), 'ryzen 3')) {
            $saran[] = 'Pertimbangkan upgrade prosesor ke i5 / Ryzen 5 atau lebih tinggi';
        }

        return view('pelanggan.upgrade', [
            'rekomendasi' => $saran,
            'input' => $request->all(),
        ]);
    }

    public function riwayat()
    {
        $transaksi = Transaksi::with('produk')->where('pembeli_id', auth()->id())->get();
        return view('pelanggan.riwayat', compact('transaksi'));
    }

    public function servisForm()
    {
        return view('pelanggan.servis');
    }

    public function servisSubmit(Request $request)
    {
        Servis::create([
            'pelanggan_id' => auth()->id(),
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'jadwal' => $request->jadwal,
        ]);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Permintaan servis berhasil dikirim.');
    }
}
