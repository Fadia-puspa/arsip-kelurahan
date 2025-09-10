<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSurat extends Model
{
    /** @use HasFactory<\Database\Factories\FileSuratFactory> */
    use HasFactory;
    protected $table = 'file_surat';

    protected $fillable = [
        'no_item',
        'berkas',
    ];
}
