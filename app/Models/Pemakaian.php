<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $fillable = ['id_pemesanan', 'nama', 'nama_kendaraan', 'bbm', 'hari', 'total_km'];
}
