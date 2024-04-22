<?php

// Pemesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = ['id_pegawai', 'id_kendaraan', 'nama', 'nama_kendaraan'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function atasan1()
    {
        return $this->belongsTo(User::class, 'id_atasan1');
    }

    public function atasan2()
    {
        return $this->belongsTo(User::class, 'id_atasan2');
    }
}
