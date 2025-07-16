<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function sinkronNomorItem()
    {
       $gabungArsip = collect(DB::select("
        SELECT id, 'masuk' AS jenis, kode_klasifikasi, tanggal,
               SUBSTRING_INDEX(SUBSTRING_INDEX(kode_klasifikasi, '/', -1), '.', 1) AS kode_utama
        FROM surat_masuk

        UNION ALL

        SELECT id, 'keluar' AS jenis, kode_klasifikasi, tanggal,
               SUBSTRING_INDEX(SUBSTRING_INDEX(kode_klasifikasi, '/', -1), '.', 1) AS kode_utama
        FROM surat_keluar

        ORDER BY kode_utama ASC, tanggal ASC
    "));

    $nomor = 1;

    foreach ($gabungArsip as $arsip) {
        $table = $arsip->jenis === 'masuk' ? 'surat_masuk' : 'surat_keluar';
        DB::table($table)->where('id', $arsip->id)->update(['nomor_item' => $nomor]);
        $nomor++;
    }

    return redirect()->back()->with('success', 'Nomor item arsip berhasil disinkron.'); 
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
