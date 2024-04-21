<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\pegawai;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $kendaraans = Kendaraan::all();
        return view('pemesanan',compact('kendaraans'));
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
        $validatedData = $request->validate([
            'nama' => 'required',
            'nama_kendaraan' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $pegawai = Pegawai::create([
                'nama' => $validatedData['nama'],
            ]);

            $kendaraan = Kendaraan::find($request->nama_kendaraan); // Ubah $request->kendaraan_id menjadi $request->nama_kendaraan
            $pemesanan = Pemesanan::create([
                'id_pegawai' => $pegawai->id,
                'nama' => $validatedData['nama'],
                'id_kendaraan' => $kendaraan->id,
                'nama_kendaraan' => $kendaraan->nama_kendaraan,
            ]);
$pemesanan->save();
            DB::commit();

            return redirect()->back()->with('success', 'Pemesanan berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
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
