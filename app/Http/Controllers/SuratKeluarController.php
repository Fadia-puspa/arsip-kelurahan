<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratKeluar = SuratKeluar::orderByDesc('created_at')->get();
        return view('surat_keluar',compact('suratKeluar'));
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
                     ->with('success', 'Surat berhasil dihapus');
    }
}
