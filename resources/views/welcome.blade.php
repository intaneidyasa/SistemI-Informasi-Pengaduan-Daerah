<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- NAVBAR -->
    <nav class="bg-[#1e2d42] text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex flex-col">
                    <span class="font-bold text-lg leading-tight">Sistem Informasi</span>
                    <span class="text-xs text-gray-300">Pengaduan Masyarakat</span>
                </div>
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="{{ url('/') }}" class="border-b-2 border-white pb-1">Beranda</a>
                    <a href="{{ url('/tentang') }}" class="text-gray-300 hover:text-white transition">Tentang</a>
                    <a href="{{ url('/cara_pengaduan') }}" class="text-gray-300 hover:text-white transition">Cara Pengaduan</a>
                    <a href="{{ url('/kontak') }}" class="text-gray-300 hover:text-white transition">Kontak</a>
                </div>
                <div class="flex space-x-3">
                    @auth
                        <!-- Jika sudah login: Tampilkan tombol Pengaduan dan Logout -->
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-1 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium transition shadow">
                            <i class="fa-solid fa-gauge"></i>
                            <span>Pengaduan</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-sm font-medium transition shadow">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <!-- Jika belum login: Tampilkan tombol Login & Register -->
                        <a href="{{ url('/login') }}" class="flex items-center space-x-1 bg-transparent hover:bg-slate-700 border border-gray-400 px-4 py-2 rounded-md text-sm font-medium transition">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ url('/register') }}" class="flex items-center space-x-1 bg-white text-slate-900 hover:bg-gray-100 px-4 py-2 rounded-md text-sm font-medium transition shadow">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Register</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="relative text-white pt-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ asset('images/logo.png') }}');"></div>
        <div class="absolute inset-0 bg-[#0d2d57]/70"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">
                    Sistem Informasi <br class="hidden md:inline">
                    Pengaduan Masyarakat
                </h1>
                <p class="text-xl font-light text-gray-200 mb-2">kepada Pemerintah Daerah</p>
                <p class="text-sm text-gray-300 leading-relaxed mb-8 max-w-2xl">
                    Wadah bagi masyarakat untuk menyampaikan laporan, keluhan, atau aspirasi terkait masalah lingkungan, infrastruktur, maupun pelayanan publik di wilayah Anda.
                </p>
            </div>
        </div>
    </header>

    <!-- LAYANAN KAMI -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 class="text-3xl font-bold text-center text-slate-800 mb-12">Layanan Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-4 text-lg">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Buat Pengaduan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Sampaikan keluhan atau laporan Anda dengan mudah dan cepat.</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mb-4 text-lg">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Tanggapan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Dapatkan tanggapan dan informasi terkait laporan Anda secara langsung.</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center mb-4 text-lg">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Transparansi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Proses penanganan pengaduan transparan dan dapat dipertanggungjawabkan.</p>
            </div>
        </div>
    </section>

    <!-- CARA MEMBUAT PENGADUAN -->
    <section class="bg-white py-20 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-16">Cara Membuat Pengaduan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <!-- Langkah 1 -->
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-[#1e2d42] text-white flex items-center justify-center text-3xl relative mb-6 shadow-md">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="absolute top-0 right-0 bg-blue-500 text-white w-7 h-7 rounded-full text-sm flex items-center justify-center font-bold border-2 border-white">1</span>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Daftar / Login</h3>
                    <p class="text-sm text-gray-500 max-w-xs">Buat akun baru atau masuk dengan akun yang sudah terdaftar.</p>
                </div>
                <!-- Langkah 2 -->
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-[#1e2d42] text-white flex items-center justify-center text-3xl relative mb-6 shadow-md">
                        <i class="fa-solid fa-file-pen"></i>
                        <span class="absolute top-0 right-0 bg-blue-500 text-white w-7 h-7 rounded-full text-sm flex items-center justify-center font-bold border-2 border-white">2</span>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Isi Formulir</h3>
                    <p class="text-sm text-gray-500 max-w-xs">Lengkapi seluruh detail pengaduan Anda dengan jelas, jujur, dan lengkap.</p>
                </div>
                <!-- Langkah 3 -->
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-[#1e2d42] text-white flex items-center justify-center text-3xl relative mb-6 shadow-md">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span class="absolute top-0 right-0 bg-blue-500 text-white w-7 h-7 rounded-full text-sm flex items-center justify-center font-bold border-2 border-white">3</span>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Kirim Laporan</h3>
                    <p class="text-sm text-gray-500 max-w-xs">Kirimkan laporan Anda dan pantau notifikasi tanggapan dari petugas.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#1e2d42] py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Menyampaikan Pengaduan?</h2>
            <p class="text-gray-300 mb-8">Suara Anda penting bagi perbaikan layanan publik di daerah kita.</p>
            @guest
                <a href="{{ url('/register') }}" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium shadow-lg transition">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Daftar Sekarang</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium shadow-lg transition">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Ke Dashboard Pengaduan</span>
                </a>
            @endguest
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#111a24] text-gray-400 text-sm pt-16 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
            <div>
                <h4 class="text-white font-bold mb-4">Sistem Informasi Pengaduan</h4>
                <p class="text-xs leading-relaxed text-gray-400">Wadah bagi masyarakat untuk menyampaikan laporan, keluhan, atau aspirasi kepada Pemerintah Daerah.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ url('/tentang') }}" class="hover:text-white transition">Tentang</a></li>
                    <li><a href="{{ url('/cara_pengaduan') }}" class="hover:text-white transition">Cara Pengaduan</a></li>
                    <li><a href="{{ url('/kontak') }}" class="hover:text-white transition">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Kontak</h4>
                <ul class="space-y-3 text-xs">
                    <li class="flex items-start space-x-2"><i class="fa-solid fa-location-dot mt-0.5 text-gray-500"></i> <span>Jl. Pemerintahan No. 1</span></li>
                    <li class="flex items-center space-x-2"><i class="fa-solid fa-phone text-gray-500"></i> <span>(0717) 000-0000</span></li>
                    <li class="flex items-center space-x-2"><i class="fa-solid fa-envelope text-gray-500"></i> <span>pengaduan@pemda.go.id</span></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-gray-800 pt-6 text-center text-xs text-gray-500">
            &copy; 2026 Sistem Pengaduan Masyarakat. Hak cipta dilindungi.
        </div>
    </footer>

</body>
</html>