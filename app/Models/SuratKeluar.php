<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    /** @use HasFactory<\Database\Factories\SuratKeluarFactory> */
    use HasFactory;
    protected $table = 'surat_keluar';

    protected $fillable = [
        'unit_pengolahan',
        'unit_pencipta',
        'nomor_berkas',
        'nomor_item',
        'kode_klasifikasi',
        'tanggal',
        'jumlah',
        'tingkat_perkembangan',
        'uraian',
        'keterangan',
    ];
}
