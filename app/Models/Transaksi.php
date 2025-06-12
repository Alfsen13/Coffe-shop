<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'produk_id',
        'pembeli_id',
        'toko_id',
        'jumlah',
        'status',
        'alamat_pengiriman', // <- ini yang penting
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'pembeli_id');
    }

    public function toko()
    {
        return $this->belongsTo(User::class, 'toko_id');
    }
}
