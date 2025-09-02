<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page - Kelurahan Cengkareng Timur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <!-- Hero Section -->
    <section class="bg-blue-900 text-white h-screen flex flex-col justify-center items-center text-center px-4">
    <!-- Gambar/Icon -->
    <img src="{{ 'img' }}/logo.png" alt="Icon Kelurahan" class="w-24 h-24 mb-6 shadow-lg" />

    <!-- Judul & Deskripsi -->
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang</h1>
    <h2 class="text-2xl md:text-3xl font-semibold mb-6">Sistem Informasi Surat Menyurat di Kelurahan Cengkareng Timur</h2>
    <p class="max-w-2xl mb-8 text-lg">
        Web ini membantu pengelolaan surat masuk, surat keluar, dan data klasifikasi secara efisien untuk mendukung pelayanan publik.
    </p>

    <!-- Tombol -->
    <a href="#fitur" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold shadow hover:bg-gray-200 transition">
        Jelajahi Menu
    </a>
</section>


    <!-- Fitur Section -->
    <section id="fitur" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 fade-in">Menu Informasi</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8">
                <div class="p-6 bg-gray-100 rounded-lg shadow fade-in">
                    <i class="fas fa-envelope text-3xl text-gray-700 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Surat Masuk</h4>
                    <p>Data surat masuk yang tercatat dan dapat dipantau secara real-time.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow fade-in">
                    <i class="fas fa-envelope-open text-3xl text-gray-700 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Surat Keluar</h4>
                    <p>Manajemen pengiriman surat keluar yang terstruktur dan terdokumentasi.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow fade-in">
                    <i class="fas fa-tags text-3xl text-gray-700 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Klasifikasi Arsip</h4>
                    <p>Kategorisasi surat untuk mempermudah pencarian dan pelacakan dokumen.</p>
                </div>
                
                <div class="p-6 bg-gray-100 rounded-lg shadow fade-in">
                    <i class="fas fa-chart-bar text-3xl text-gray-700 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Laporan & Grafik</h4>
                    <p>Visualisasi data surat dalam bentuk grafik yang mudah dipahami.</p>
                </div>
            
                
            </div>
<div class="text-center mt-12">
                <a href="/dashboard" class="bg-gray-900 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-gray-700 transition">Lihat Dashboard</a>
            </div>
            
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6">
        <p>&copy; 2025 Kelurahan Cengkareng Timur.By. Fadia Puspa Sari</p>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // Fade-in scroll animation
        const faders = document.querySelectorAll('.fade-in');
        const appearOptions = {
            threshold: 0.2,
            rootMargin: "0px 0px -50px 0px"
        };

        const appearOnScroll = new IntersectionObserver(function (entries, appearOnScroll) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('visible');
                appearOnScroll.unobserve(entry.target);
            });
        }, appearOptions);

        faders.forEach(fader => appearOnScroll.observe(fader));
    </script>
</body>
</html>
