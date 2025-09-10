<x-layout>
  {{-- Tambahkan Bootstrap Icons jika belum --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

  <style>
    body {
      background-color: #f9f9f9;
    }

    .page-title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }

    .card {
      border: none;
      border-radius: 10px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #20c997;
      color: white;
      font-weight: 600;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .table {
      margin: 0;
      white-space: nowrap;
    }

    .btn-view {
      font-size: 0.85rem;
      padding: 6px 12px;
    }
  </style>

  <div class="container py-4">
    <h2 class="page-title">📥 Daftar Surat Masuk</h2>


    {{-- Tabel Surat Masuk --}}
    <div class="card shadow-sm">
      <div class="card-header">Surat Masuk Terbaru</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="myTable" class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Unit Pengolahan</th>
                <th>Unit Pencipta</th>
                <th>Nomor Berkas</th>
                <th>Nomor Item Arsip</th>
                <th>Kode Klasifikasi</th>
                <th>Uraian</th>
                <th>Tanggal</th>
                <th>Jumlah Lembar</th>
                <th>Tingkat Perkembangan</th>
                <th>keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($suratMasuk as $index => $surat)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $surat['unit_pengolahan'] }}</td>
                  <td>{{ $surat['unit_pencipta'] }}</td>
                  <td>{{ $surat['nomor_berkas'] }}</td>
                  <td>{{ $surat['nomor_item'] }}</td>
                  <td>{{ $surat['kode_klasifikasi'] }}</td>
                  <td>{{ $surat['uraian'] }}</td>
                  <td>{{ \Carbon\Carbon::parse($surat['tanggal'])->format('d M Y') }}</td>
                  <td>{{ $surat['jumlah'] }}</td>
                  <td>{{ $surat['tingkat_perkembangan'] }}</td>
                  <td>{{ $surat['keterangan'] }}</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-secondary dropdown-toggle btn-view" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i> Aksi
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a class="{{ auth()->check() !== true ? 'd-none' : '' }}" href="{{ route('surat-masuk.edit', $surat['id']) }}" class="dropdown-item">
                            <i class="bi bi-pencil"></i> Edit
                          </a>
                        </li>
                        <li>
                          <a class="{{ auth()->check() !== true ? 'd-none' : '' }}" href="{{ route('surat-masuk.destroy', ['id' => $surat['id'], 'kode_klasifikasi' => $surat['kode_klasifikasi']]) }}" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus surat ini?')">
                            <i class="bi bi-trash"></i> Hapus
                          </a>
                        </li>
                        @php
                          $fileSurat = \App\Models\FileSurat::where('klasifikasi', $surat['kode_klasifikasi'])->get();
                          $filePath = null;
                          $fileUrl = null;
                          foreach ($fileSurat as $berkas) {
                            $filePath = public_path('berkas/' . $berkas['berkas']);
                            $fileUrl = asset('berkas/' . $berkas['berkas']);
                          }
                        @endphp
                        @if ($filePath && file_exists($filePath))
                        <li>
                          <a href="{{ $fileUrl }}" class="dropdown-item text-success" target="_blank">
                            <i class="bi bi-eye"></i> Lihat
                          </a>
                        </li>
                        @endif
                      </ul>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<!-- JSZip untuk Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            dom:
                "<'row'<'col-sm-6'B><'col-sm-6 text-end'f>>" +  // baris 1: tombol di kiri, search di kanan
                "<'row'<'col-sm-12'tr>>" +                      // baris 2: tabel
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",            // baris 3: info & pagination
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export ke Excel',
                    title: 'Data Export',
                    exportOptions: {
                        // Hanya kolom sampai "Keterangan" (misal kolom ke-1 sampai ke-11, index 0-10)
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    }
                }
            ]
        });
    });
  </script>
  @if (session('hapus'))
      <script>
        Swal.fire({
          title: "Selamat!",
          text: `{{ session('hapus') }}`,
          icon: "success"
        });
      </script>
  @endif
</x-layout>
