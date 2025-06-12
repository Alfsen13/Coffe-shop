<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'pembeli_id',
        'transaksi_id', // ← tambahkan ini!
        'rating',
        'komentar'
    ];

    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public function pembeli() {
        return $this->belongsTo(User::class, 'pembeli_id');
    }

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
}
