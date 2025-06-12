<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Ulasan;

class TokoController extends Controller
{
    public function dashboard()
    {
        return view('toko.dashboard');
    }

    public function laporan()
    {
        $transaksi = Transaksi::with(['produk', 'pembeli'])->where('toko_id', auth()->id())->get();
        return view('toko.laporan', compact('transaksi'));
    }

    public function ulasan()
    {
        $ulasan = Ulasan::with(['produk', 'pembeli'])->whereHas('produk', function ($query) {
            $query->where('toko_id', auth()->id());
        })->get();
        return view('toko.ulasan', compact('ulasan'));
    }
    
    public function updateTransaksi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai',
        ]);

        $trx = \App\Models\Transaksi::with('produk')->where('id', $id)
            ->where('toko_id', auth()->id())
            ->firstOrFail();
            
        $trx->status = $request->status;
        $trx->save();

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
