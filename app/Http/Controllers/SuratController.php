<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('upload');
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
        $validated = $request->validate([
            'unit_pengolahan'      => 'required|string',
            'unit_pencipta'        => 'required|string|max:255',
            'nomor_berkas'         => 'nullable|string|max:255',
            'nomor_item'           => 'nullable|string|max:255',
            'kode_klasifikasi'     => 'nullable|string|max:255',
            'tanggal'              => 'required|date',
            'jumlah'               => 'required|integer|min:1',
            'tingkat_perkembangan' => 'nullable|string|max:255',
            'uraian'               => 'required|string',
            'keterangan'           => 'nullable|string',
            'jenis_surat'          => 'required|in:masuk,keluar',
        ], [
            'unit_pengolahan.required' => 'Unit Pengolahan wajib diisi.',
            'unit_pencipta.required' => 'Unit Pencipta wajib diisi.',
            'nomor_berkas.string' => 'Nomor Berkas harus berupa teks.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal harus 1.',
            'uraian.required' => 'Uraian tidak boleh kosong.',
            'jenis_surat.required' => 'Jenis surat harus dipilih.',
            'jenis_surat.in' => 'Jenis surat harus antara surat masuk atau surat keluar.',
        ]);

        if ($validated['jenis_surat'] === 'masuk') {
            SuratMasuk::create($validated);  
            return redirect('/suratmasuk')->with('success', 'Data surat masuk berhasil disimpan.');
        } else {
            SuratKeluar::create($validated);
            return redirect('/suratkeluar')->with('success', 'Data surat keluar berhasil disimpan.');
        }
        // dd($request->all());

        

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
