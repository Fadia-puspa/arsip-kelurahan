<?php

namespace App\Http\Controllers;

use App\Models\FileSurat;
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

        // Simpan nomor_item lama sebelum update
        $oldNomorItem = $surat->nomor_item;

        // Ambil semua data kecuali file
        $data = $request->except('berkas');

        // Update data surat masuk
        $surat->update($data);

        // Ambil nomor_item baru setelah update
        $newNomorItem = $surat->nomor_item;

        // Jika nomor_item berubah, update juga no_item di FileSurat
        if ($oldNomorItem !== $newNomorItem) {
            FileSurat::where('no_item', $oldNomorItem)->update(['no_item' => $newNomorItem]);
        }

        // Jika ada file diunggah
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $namaFile = 'sk_' . $file->getClientOriginalName();
            $file->move(public_path('berkas'), $namaFile);

            // Hapus file lama jika ada
            $fileSurats = FileSurat::where('no_item', $newNomorItem)->get();
            foreach ($fileSurats as $fileSurat) {
                $filePath = public_path('berkas/' . $fileSurat->berkas);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
            FileSurat::where('no_item', $newNomorItem)->delete();

            // Simpan file baru ke tabel file_surat
            FileSurat::create([
                'no_item' => $newNomorItem,
                'berkas' => $namaFile,
            ]);
        }

        return redirect('/suratkeluar')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $nomor_item)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        // Hapus file fisik dari folder 'berkas' sesuai field 'berkas'
        $fileSurats = FileSurat::where('no_item', $nomor_item)->get();
        foreach ($fileSurats as $fileSurat) {
            $filePath = public_path('berkas/' . $fileSurat->berkas);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
        FileSurat::where('no_item', $nomor_item)->delete();

        return redirect('/suratkeluar')
                     ->with('hapus', 'Surat berhasil dihapus');
    }
}
