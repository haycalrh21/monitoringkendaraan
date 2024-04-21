<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PemesananExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pemesanan::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pegawai',
            'Nama Kendaraan',
            'Status 1',
            'Status 2',
            'ID atasan 1',
            'ID atasan 2',
            'Waktu Pemesanan',
            'Waktu Di Update',
        ];
    }

    public function map($pemesanan): array
    {
        return [
            $pemesanan->id,
            $pemesanan->nama,
            $pemesanan->nama_kendaraan,
            $pemesanan->status1,
            $pemesanan->status2,
            $pemesanan->id_atasan1,
            $pemesanan->id_atasan1,

            Carbon::parse($pemesanan->created_at)->format('Y-m-d H:i:s'),
            Carbon::parse($pemesanan->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
