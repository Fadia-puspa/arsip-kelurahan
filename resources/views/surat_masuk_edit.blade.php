<x-layout>
  <div class="container py-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Surat Menyurat</h4>
      </div>

      <div class="card-body">
        <form action="{{ route('update_suratmasuk',['id'=>$surat->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="unit_pengolahan" class="form-label">Unit Pengolahan</label>
              <input type="text" name="unit_pengolahan" class="form-control" value="{{ $surat->unit_pengolahan }}">
            </div>
            <div class="col-md-6">
              <label for="unit_pencipta" class="form-label">Unit Pencipta</label>
              <input type="text" name="unit_pencipta" class="form-control" value="{{ $surat->unit_pencipta }}">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="nomor_berkas" class="form-label">Nomor Berkas</label>
              <input type="text" name="nomor_berkas" class="form-control" value="{{ $surat->nomor_berkas }}">
            </div>
            <div class="col-md-6">
              <label for="nomor_item" class="form-label">Nomor Item Arsip</label>
              <input type="text" name="nomor_item" class="form-control" value="{{ $surat->nomor_item }}">
            </div>
          </div>

          <div class="mb-3">
            <label for="kode_klasifikasi" class="form-label">Kode Klasifikasi</label>
            <input type="text" name="kode_klasifikasi" class="form-control" value="{{ $surat->kode_klasifikasi }}">
          </div>

          <div class="mb-3">
            <label for="uraian" class="form-label">Uraian Informasi Arsip</label>
            <textarea name="uraian" class="form-control" rows="3">{{ $surat->uraian }}</textarea>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="{{ $surat->tanggal }}">
            </div>
            <div class="col-md-6">
              <label for="jumlah" class="form-label">Jumlah Lembar</label>
              <input type="number" name="jumlah" class="form-control" value="{{ $surat->jumlah }}">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="tingkat_perkembangan" class="form-label">Tingkat Perkembangan</label>
              <input type="text" name="tingkat_perkembangan" class="form-control" value="{{ $surat->tingkat_perkembangan }}">
            </div>
            <div class="col-md-6">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="2">{{ $surat->keterangan }}</textarea>
            </div>
          </div>

          <div class="mb-3">
            <label for="berkas" class="form-label"><span class="text-muted" style="font-size: 0.9em;">(biarkan kosong jika tidak ingin diubah)</span></label>
            <input type="file" name="berkas" class="form-control" accept="application/pdf">
          </div>

          <div class="text-end">
            <a href="/suratmasuk" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>
