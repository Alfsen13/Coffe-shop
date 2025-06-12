<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;

class TeknisiController extends Controller
{
    public function index()
    {
        $servis = Servis::with('pelanggan')->latest()->get();
        return view('teknisi.servis.index', compact('servis'));
    }

    public function show($id)
    {
        $servis = Servis::with('pelanggan')->findOrFail($id);
        return view('teknisi.servis.show', compact('servis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dijadwalkan,selesai',
            'catatan' => 'nullable|string',
        ]);

        $servis = Servis::findOrFail($id);
        $servis->status = $request->status;
        $servis->catatan = $request->catatan;
        $servis->save();

        return redirect()->route('teknisi.servis.index')->with('success', 'Status servis berhasil diperbarui.');
    }
}
