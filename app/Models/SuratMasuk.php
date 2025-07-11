<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';

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
