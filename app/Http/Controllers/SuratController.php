<?php

namespace App\Http\Controllers;

use App\Models\FileSurat;
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
            'nomor_item'           => 'nullable|string|max:255',
            'nomor_berkas'         => 'nullable|string|max:255',
            'kode_klasifikasi'     => 'required|string|max:255|unique:surat_masuk,kode_klasifikasi|unique:surat_keluar,kode_klasifikasi',
            'tanggal'              => 'required|date',
            'jumlah'               => 'required|integer|min:1',
            'tingkat_perkembangan' => 'nullable|string|max:255',
            'uraian'               => 'required|string',
            'keterangan'           => 'nullable|string',
            'jenis_surat'          => 'required|in:masuk,keluar',
            'file_surat'           => 'required|file|mimes:pdf|max:5120',
        ], [
            'unit_pengolahan.required' => 'Unit Pengolahan wajib diisi.',
            'unit_pencipta.required' => 'Unit Pencipta wajib diisi.',
            'nomor_item.string' => 'Nomor Item harus berupa teks.',
            'nomor_berkas.string' => 'Nomor Berkas harus berupa teks.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal harus 1.',
            'uraian.required' => 'Uraian tidak boleh kosong.',
            'jenis_surat.required' => 'Jenis surat harus dipilih.',
            'jenis_surat.in' => 'Jenis surat harus antara surat masuk atau surat keluar.',
            'file_surat.file' => 'File surat harus berupa file.',
            'file_surat.mimes' => 'File surat harus berupa file pdf.',
            'file_surat.max' => 'File surat maksimal 5MB.',
            'file_surat.required' => 'File surat wajib diisi.',
            'kode_klasifikasi.required' => 'Kode Klasifikasi wajib diisi.',
            'kode_klasifikasi.string' => 'Kode Klasifikasi harus berupa teks.',
            'kode_klasifikasi.max' => 'Kode Klasifikasi maksimal 255 karakter.',
            'kode_klasifikasi.unique' => 'Kode Klasifikasi sudah digunakan.',
        ]);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = $validated['jenis_surat'] == 'masuk' ? 'sm_' . $file->getClientOriginalName() : 'sk_' . $file->getClientOriginalName();
            $file->move(public_path('berkas'), $fileName);

            // Simpan ke tabel file_surat sesuai field: klasifikasi (dari kode_klasifikasi), berkas
            FileSurat::create([
                'klasifikasi' => $validated['kode_klasifikasi'] ?? null,
                'berkas' => $fileName,
            ]);

            // Simpan nama file ke $validated jika ingin tetap menyimpan di surat_masuk/keluar
            $validated['file_surat'] = $fileName;
        }

        if ($validated['jenis_surat'] === 'masuk') {
            SuratMasuk::create($validated);  
            return redirect('/suratmasuk')->with('success', 'Data surat masuk berhasil disimpan.');
        } else {
            SuratKeluar::create($validated);
            return redirect('/suratkeluar')->with('success', 'Data surat keluar berhasil disimpan.');
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
