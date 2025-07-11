<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('surat_masuk', function (Blueprint $table) {
        $table->id();
        $table->text('unit_pengolahan');
        $table->string('unit_pencipta');
        $table->string('nomor_berkas')->nullable();
        $table->string('nomor_item')->nullable();
        $table->string('kode_klasifikasi')->nullable();
        $table->text('uraian');
        $table->date('tanggal');
        $table->integer('jumlah');
        $table->string('tingkat_perkembangan')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
