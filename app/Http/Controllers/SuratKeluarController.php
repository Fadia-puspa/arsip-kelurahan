<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $kodeUrutan = [
    'KA', 'PP', 'KI', 'PU', 'AT', 'BM', 'PC', 'PD', 'PK', 'KB',
    'PH', 'KH', 'PI', 'KP', 'KU', 'KS', 'KT', 'TR', 'LH', 'LI',
    'BP', 'TM', 'PO', 'KR', 'RR', 'PW', 'PS', 'SO', 'ST', 'PT',
    'ES', 'PA', 'UD', 'PN', 'KG', 'DL', 'HK', 'RB', 'IP', 'CB', 'TB', 'OT', 'G', 'HM'
];

$kodeUrutanString = "'" . implode("','", $kodeUrutan) . "'";

$suratKeluar = SuratKeluar::orderByRaw("
    FIELD(
      SUBSTRING_INDEX(SUBSTRING_INDEX(kode_klasifikasi, '/', -1), '.', 1),
      $kodeUrutanString
    )
  ")
  ->orderBy('tanggal', 'ASC')
  ->get();



return view('surat_keluar', compact('suratKeluar'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SuratKeluar::create($request->all());

    // Panggil sinkronisasi otomatis
    (new \App\Http\Controllers\ArsipController)->sinkronNomorItem();

    return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil disimpan dan nomor item disinkron.');
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
    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
    return view('surat_keluar_edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->update($request->all());

        return redirect('/suratkeluar')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
                $surat = SuratKeluar::findOrFail($id);
    $surat->delete();

    return redirect('/suratkeluar')
                     ->with('hapus', 'Surat berhasil dihapus');
    }
}
