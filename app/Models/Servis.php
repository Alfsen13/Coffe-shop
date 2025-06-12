<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis';

    protected $fillable = [
        'pelanggan_id',
        'jenis',
        'lokasi',
        'jadwal',
        'status',
        'catatan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }
}
