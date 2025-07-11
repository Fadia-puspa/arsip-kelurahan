<x-layout>
    <style>
        .konten {
            max-width: 100%;
            padding: 2rem 1rem 4rem;
        }

        .card {
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            padding: 1rem 1.25rem;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 1rem 1.5rem;
            text-align: right;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.2);
        }
    </style>

    <div class="konten">
        {{-- FORM SURAT MASUK --}}
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-envelope-arrow-down-fill"></i> Form Surat 
            </div>
            <form action="/upload_surat" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Unit Pengolahan</label>
                        <input type="text" name="unit_pengolahan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit Pencipta</label>
                        <input type="text" name="unit_pencipta" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Berkas</label>
                        <input type="text" name="nomor_berkas" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Item Arsip</label>
                        <input type="text" name="nomor_item" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kode Klasifikasi</label>
                        <input type="text" name="kode_klasifikasi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Uraian Informasi Arsip</label>
                        <textarea name="uraian" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tingkat Perkembangan</label>
                        <input type="text" name="tingkat_perkembangan" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis_surat">Jenis Surat:</label>
                        <select name="jenis_surat" id="jenis_surat" class="form-control" required> 
                        <option value="">Jenis Surat</option>
                        <option value="masuk">Surat Masuk</option>
                        <option value="keluar">Surat Keluar</option>
                        </select>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Surat
                    </button>
                </div>
            </form>
        </div>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>
</x-layout>
