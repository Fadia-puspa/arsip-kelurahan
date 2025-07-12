
@if (isset(auth()->user()->role))
<x-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <div class="w-full px-8 py-4 space-y-8"> <!-- Perubahan utama di sini -->
        <div class="overflow-hidden rounded-md shadow border border-gray-300 mb-4">
            <table class="min-w-full bg-gray-100">
                <thead>
                    <tr>
                        <th class="text-left px-6 py-3 text-lg text-gray-800 font-semibold">
                            Dashboard Kelurahan Cengkareng Timur
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
            <div onclick="keluar()" style="cursor:pointer;" class="bg-blue-100 rounded-md shadow-md flex items-center p-4 space-x-4">
                <div class="bg-blue-600 text-white p-3 rounded-md">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <div class="flex flex-col text-sm text-gray-800">
                    <span>Surat Keluar</span>
                    <span class="font-semibold mt-1">{{ $suratKeluar }}</span>
                </div>
            </div>

            <div onclick="masuk()" style="cursor:pointer;" class="bg-green-100 rounded-md shadow-md flex items-center p-4 space-x-4">
                <div class="bg-green-600 text-white p-3 rounded-md">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <div class="flex flex-col text-sm text-gray-800">
                    <span>Surat Masuk</span>
                    <span class="font-semibold mt-1">{{ $suratMasuk }}</span>
                </div>
            </div>

            {{-- <div class="bg-purple-100 rounded-md shadow-md flex items-center p-4 space-x-4">
                <div class="bg-purple-800 text-white p-3 rounded-md">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="flex flex-col text-sm text-gray-800">
                    <span>Users</span>
                    <span class="font-semibold mt-1">-</span>
                </div>
            </div> --}}
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-md shadow-md p-6">
            <h3 class="text-gray-800 font-semibold mb-4 text-lg">Informasi Surat</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 font-semibold border border-gray-300">No</th>
                            <th class="px-4 py-2 font-semibold border border-gray-300">Jenis Surat</th>
                            <th class="px-4 py-2 font-semibold border border-gray-300">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 border-r border-gray-300">1</td>
                            <td class="px-4 py-2 border-r border-gray-300">Surat Masuk</td>
                            <td class="px-4 py-2 border-r border-gray-300">{{ $suratMasuk }}</td>
                        </tr>
                        <tr class="border border-gray-300 bg-gray-50">
                            <td class="px-4 py-2 border-r border-gray-300">2</td>
                            <td class="px-4 py-2 border-r border-gray-300">Surat Keluar</td>
                            <td class="px-4 py-2 border-r border-gray-300">{{ $suratKeluar }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="mb-3">Grafik Surat Masuk & Keluar</h5>
        <canvas id="chartSurat" height="100"></canvas>
      </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
      Swal.fire({
        title: "Berhasil!",
        text: `{{ session('success') }}`,
        icon: "success"
      });
    </script>
    @endif
    <script>
      
      var suratMasukData = @json($suratMasukData);
      var suratKeluarData = @json($suratKeluarData);

      const ctx = document.getElementById('chartSurat').getContext('2d');
      const chartSurat = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              label: 'Surat Masuk',
              backgroundColor: '#0d6efd',
              data: suratMasukData
            },
            {
              label: 'Surat Keluar',
              backgroundColor: '#ffc107',
              data: suratKeluarData
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          }
        }
      });
      function masuk(){
        window.location.href = '/suratmasuk';

      }

      function keluar(){
        window.location.href = '/suratkeluar';
      }
  </script>

</x-layout>

 @else
 <x-layout>
  <style>
    body {
      background-color: #f9f9f9;
    }

    .page-title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 30px;
    }

    .info-box {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .info-box:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .info-icon {
      font-size: 2rem;
      margin-right: 15px;
      color: #0d6efd;
    }

    .info-text {
      font-size: 1.1rem;
      color: #666;
    }

    .info-number {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
    }

    canvas {
      background: white;
      border-radius: 10px;
      padding: 20px;
    }
  </style>

  <div class="container py-4">
    <h2 class="page-title">📊 Dashboard Pengguna</h2>

    <!-- Info Boxes -->
    <div class="row g-2 mb-4">
      <div class="col-md-6 col-lg-6">
        <div class="info-box d-flex align-items-center">
          <div class="info-icon">📥</div>
          <div>
            <div class="info-text">Total Surat Masuk</div>
            <div class="info-number">{{ $suratMasuk }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="info-box d-flex align-items-center">
          <div class="info-icon">📤</div>
          <div>
            <div class="info-text">Total Surat Keluar</div>
            <div class="info-number">{{ $suratKeluar }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chart -->
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="mb-3">Grafik Surat Masuk & Keluar</h5>
        <canvas id="chartSurat" height="100"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var suratMasukData = @json($suratMasukData);
    var suratKeluarData = @json($suratKeluarData);

    const ctx = document.getElementById('chartSurat').getContext('2d');
    const chartSurat = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
          {
            label: 'Surat Masuk',
            backgroundColor: '#0d6efd',
            data: suratMasukData
          },
          {
            label: 'Surat Keluar',
            backgroundColor: '#ffc107',
            data: suratKeluarData
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        }
      }
    });
  </script>
</x-layout>

@endif