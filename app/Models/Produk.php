<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = ['toko_id', 'nama', 'kategori', 'deskripsi', 'harga', 'stok', 'foto'];

    public function toko() {
        return $this->belongsTo(User::class, 'toko_id');
    }

    public function ulasan() {
        return $this->hasMany(Ulasan::class);
    }
}
