<?php

namespace App\Http\Controllers;

use App\Models\FileSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
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

$suratMasuk = SuratMasuk::orderByRaw("
    FIELD(
      SUBSTRING_INDEX(SUBSTRING_INDEX(kode_klasifikasi, '/', -1), '.', 1),
      $kodeUrutanString
    )
  ")
  ->orderBy('tanggal', 'ASC')
  ->get();



return view('surat_masuk', compact('suratMasuk'));

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
    
    

    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
        SuratMasuk::create($request->all());

    // Panggil sinkronisasi setelah simpan
    (new \App\Http\Controllers\ArsipController)->sinkronNomorItem();

    return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil disimpan dan nomor item disinkron.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
    return view('surat_masuk_edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = SuratMasuk::findOrFail($id);

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
            $namaFile = 'sm_' . $file->getClientOriginalName();
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

        return redirect('/suratmasuk')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $nomor_item)
    {
        $surat = SuratMasuk::findOrFail($id);
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

        return redirect('/suratmasuk')
                     ->with('hapus', 'Surat berhasil dihapus');
    }
}