<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Models\Kendaraan;
use App\Models\pegawai;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data pemesanan per bulan dengan status1 Disetujui
        $dataPerBulan = Pemesanan::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->where('status1', 'Disetujui')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan')
            ->toArray();

        // Inisialisasi array bulan-bulan
        $bulanLabels = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Mengisi data bulan yang kosong dengan nilai nol
        $dataBulan = array_replace(array_fill(1, 12, 0), $dataPerBulan);

        // Mengonversi data bulan ke dalam format yang dapat digunakan oleh chart
        $dataChart = array_values($dataBulan);

        return view('admin.admin', compact('dataChart', 'bulanLabels'));
    }
    public function pegawai()
    {
        $pegawais = Pegawai::all();
        return view('admin.pegawai', compact('pegawais'));
    }
    public function kendaraan()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan', compact('kendaraans'));
    }

    public function pemesanan()
    {
        $pemesanans = Pemesanan::all();
        $pegawais = pegawai::all();
        $kendaraans = Kendaraan::all();
        return view('admin.pemesanan', compact('kendaraans', 'pegawais', 'pemesanans'));
    }


    public function export()
    {
        return Excel::download(new PemesananExport, 'pemesanan.xlsx');
    }
    public function kirimpegawai(Request $request)
    {
        $validaasi = $request->validate([
            'nama' => 'required'
        ]);


        try {
            $pegawai = new Pegawai([
                'nama' => $validaasi['nama'],
            ]);

            $pegawai->save();
            return redirect()->route('pegawai');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function kirimkendaraan(Request $request)
    {
        $validasi = $request->validate([
            'nama_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'service' => 'required',
            'jenis' => 'required',
        ]);

        // dd($validasi);
        try {
            $kendaraan = Kendaraan::create([
                'nama_kendaraan' => $validasi['nama_kendaraan'],
                'plat_nomor' => $validasi['plat_nomor'],
                'jenis' => $validasi['jenis'],
                'service' => $validasi['service'],
            ]);

            $kendaraan->save();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function kirimpemesanan(Request $request)
    {
        try {
            $pegawai = pegawai::find($request->nama);
            $kendaraan = Kendaraan::find($request->nama_kendaraan);

            $pemesanan = Pemesanan::create([
                'id_pegawai' => $pegawai->id,
                'nama' => $pegawai->nama,
                'id_kendaraan' => $kendaraan->id,
                'nama_kendaraan' => $kendaraan->nama_kendaraan,
            ]);
            $pemesanan->save();
            return redirect()->back()->with('success', 'Pemesanan berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
