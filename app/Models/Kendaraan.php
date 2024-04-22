<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = ["nama_kendaraan", "jenis", "plat_nomor", "jumlah_km"];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_kendaraan');
    }
}
