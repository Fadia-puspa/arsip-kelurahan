<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratKeluar = SuratKeluar::count();
        $suratMasuk = SuratMasuk::count();

        // Mendapatkan tahun saat ini
        $tahun = Carbon::now()->year;

        // Ambil jumlah Surat Masuk dan Surat Keluar untuk setiap bulan dalam setahun
        $suratMasukData = [];
        $suratKeluarData = [];
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $suratMasukData[] = SuratMasuk::whereMonth('tanggal', $bulan)
                                        ->whereYear('tanggal', $tahun)
                                        ->count();
            $suratKeluarData[] = SuratKeluar::whereMonth('tanggal', $bulan)
                                            ->whereYear('tanggal', $tahun)
                                            ->count();
        }

        return view('dashboard', compact(
            'suratKeluar', 
            'suratMasuk',
            'suratMasukData',
            'suratKeluarData',
        ));
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
