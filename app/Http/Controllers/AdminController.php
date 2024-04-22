<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Models\Kendaraan;
use App\Models\pegawai;
use App\Models\Pemakaian;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {

        $dataPerBulan = Pemesanan::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->where('status1', 'Disetujui')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan')
            ->toArray();


        $bulanLabels = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];


        $dataBulan = array_replace(array_fill(1, 12, 0), $dataPerBulan);


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

    public function pemakaian()
    {
        $pemesanans = Pemesanan::all();
        $pemakaians = Pemakaian::all();
        return view('admin.pemakaian', compact('pemesanans', 'pemakaians'));
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
            'jenis' => 'required',
            'jumlah_km' => 'required',
        ]);



        try {
            $kendaraan = Kendaraan::create([
                'nama_kendaraan' => $validasi['nama_kendaraan'],
                'plat_nomor' => $validasi['plat_nomor'],
                'jenis' => $validasi['jenis'],
                'jumlah_km' => $validasi['jumlah_km'],

            ]);

            $kendaraan->save();
            return redirect()->back()->with('success', 'suksess');
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

            if ($kendaraan->status === 'Tersedia' && $pegawai->status === 'Tersedia') {
                $kendaraan->status = 'Tidak Tersedia';
                $pegawai->status = 'Tidak Tersedia';
                $kendaraan->save();
                $pegawai->save();
            }
            return redirect()->back()->with('success', 'Pemesanan berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function kirimpemakaian(Request $request)
    {
        $validasi = $request->validate([
            'id_pemesanan' => 'required',
            'nama' => 'required',
            'nama_kendaraan' => 'required',
            'bbm' => 'required',
            'hari' => 'required',
            'total_km' => 'required',
        ]);

        try {
            $pemakaian = Pemakaian::create([
                'id_pemesanan' => $validasi['id_pemesanan'],
                'nama' => $validasi['nama'],
                'nama_kendaraan' => $validasi['nama_kendaraan'],
                'bbm' => $validasi['bbm'],
                'hari' => $validasi['hari'],
                'total_km' => $validasi['total_km'],
            ]);
            $pemesanan = Pemesanan::find($validasi['id_pemesanan']);
            $kendaraan = Kendaraan::where('nama_kendaraan', $validasi['nama_kendaraan'])->first();
            $pegawai = pegawai::where('nama', $validasi['nama'])->first();
            // dd($kendaraan);
            if ($kendaraan && $kendaraan->status === 'Tidak Tersedia' && $pegawai && $pegawai->status === 'Tidak Tersedia' && $pemesanan && $pemesanan->statuspemesanan === 'Belum Selesai') {
                $kendaraan->status = 'Tersedia';
                $pegawai->status = 'Tersedia';
                $pemesanan->statuspemesanan = 'Selesai';
                $kendaraan->jumlah_km += $validasi['total_km'];
                $pemesanan->save();
                $kendaraan->save();
                $pegawai->save();
            }

            return redirect()->back()->with('success', ' berhasil disimpan.');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'error bro');
        }
    }


    public function getData($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        return response()->json([
            'nama' => $pemesanan->nama,
            'nama_kendaraan' => $pemesanan->nama_kendaraan,
        ]);
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
