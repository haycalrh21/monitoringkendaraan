<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtasanControler extends Controller
{


    public function persetejuan()
    {

        $pemesanans = Pemesanan::all();
        return view('atasan.persetejuan', compact(('pemesanans')));
    }
    public function gantistatus(Request $request, $id)
    {

        $pemesanans = Pemesanan::find($id);


        if ($pemesanans->id_atasan1 == null) {
            $pemesanans->status1 = "Disetujui";
            $pemesanans->id_atasan1 = Auth::id();
        } else {

            if ($pemesanans->id_atasan1 == Auth::id()) {

                // return response()->json(['message' => 'Tidak dapat mengatur id_atasan2 karena id_atasan1 sudah diatur oleh pengguna saat ini.'], 422);
            } else {

                $pemesanans->status2 = "Disetujui";
                $pemesanans->id_atasan2 = Auth::id();
            }
        }

        $pemesanans->save(); // Simpan perubahan status1, id_atasan1, status2, dan id_atasan2

        return redirect()->back()->with("success", "");
    }










    public function index()
    {
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
