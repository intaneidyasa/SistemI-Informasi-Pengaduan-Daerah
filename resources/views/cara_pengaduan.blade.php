<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Mengajukan Pengaduan - Sistem Informasi Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] font-sans antialiased flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-[#1e2d42] text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex flex-col">
                    <span class="font-bold text-lg leading-tight">Sistem Informasi</span>
                    <span class="text-xs text-gray-300">Pengaduan Masyarakat</span>
                </div>
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="{{ url('/') }}" class="text-gray-300 hover:text-white transition">Beranda</a>
                    <a href="{{ url('/tentang') }}" class="text-gray-300 hover:text-white transition">Tentang</a>
                    <a href="{{ url('/cara_pengaduan') }}" class="border-b-2 border-white pb-1 font-semibold">Cara Pengaduan</a>
                    <a href="{{ url('/kontak') }}" class="text-gray-300 hover:text-white transition">Kontak</a>
                </div>
                <div class="flex space-x-3">
                    @auth
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

    <!-- HERO HEADER -->
    <header class="bg-gradient-to-r from-[#162a45] via-[#1d4ed8] to-[#2563eb] text-white py-12 text-center shadow-inner">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-1 tracking-wide">Cara Mengajukan Pengaduan</h1>
            <p class="text-sm text-blue-100">Ikuti langkah-langkah berikut agar laporan Anda diproses dengan cepat.</p>
        </div>
    </header>

    <!-- CONTENT SECTION -->
    <main class="flex-grow py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <section class="mb-20 text-center">
                <h2 class="text-2xl font-bold text-slate-800 mb-1">Alur Pengaduan</h2>
                <p class="text-xs text-gray-500 mb-12">Hanya membutuhkan beberapa langkah sederhana.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-blue-500 text-4xl mb-4"><i class="fa-solid fa-user-plus"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">1. Registrasi / Login</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Buat akun terlebih dahulu kemudian login ke dalam sistem.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-emerald-600 text-4xl mb-4"><i class="fa-solid fa-file-pen"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">2. Isi Form Pengaduan</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Masukkan judul, kategori, lokasi, dan deskripsi laporan secara lengkap.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-red-500 text-4xl mb-4"><i class="fa-solid fa-camera"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">3. Upload Bukti</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Sertakan foto sebagai bukti agar laporan lebih mudah diverifikasi.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-amber-500 text-4xl mb-4"><i class="fa-solid fa-paper-plane"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">4. Kirim Pengaduan</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Klik tombol kirim untuk mengirim laporan ke Pemerintah Daerah.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-cyan-500 text-4xl mb-4"><i class="fa-solid fa-user-gear"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">5. Diproses Petugas</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Petugas akan memverifikasi dan memberikan tanggapan terhadap laporan Anda.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                        <div class="text-green-600 text-4xl mb-4"><i class="fa-solid fa-circle-check"></i></div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">6. Pengaduan Selesai</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">Status laporan akan berubah menjadi selesai apabila telah ditindaklanjuti.</p>
                    </div>
                </div>
            </section>

            <!-- PROSES PENANGANAN -->
            <section class="mb-20">
                <h2 class="text-2xl font-bold text-center text-slate-800 mb-10">Proses Penanganan Laporan</h2>
                <div class="flex flex-wrap justify-center items-center gap-4 md:gap-8 text-sm font-semibold text-slate-700">
                    <div class="flex items-center space-x-2 bg-white px-5 py-3 rounded-lg border border-gray-100 shadow-sm"><span>📝</span> <span>Dibuat</span></div>
                    <div class="w-4 h-0.5 bg-gray-300 hidden md:block"></div>
                    <div class="flex items-center space-x-2 bg-white px-5 py-3 rounded-lg border border-gray-100 shadow-sm"><span>📩</span> <span>Dikirim</span></div>
                    <div class="w-4 h-0.5 bg-gray-300 hidden md:block"></div>
                    <div class="flex items-center space-x-2 bg-white px-5 py-3 rounded-lg border border-gray-100 shadow-sm"><span>🔍</span> <span>Diverifikasi</span></div>
                    <div class="w-4 h-0.5 bg-gray-300 hidden md:block"></div>
                    <div class="flex items-center space-x-2 bg-white px-5 py-3 rounded-lg border border-gray-100 shadow-sm"><span>⚙️</span> <span>Diproses</span></div>
                    <div class="w-4 h-0.5 bg-gray-300 hidden md:block"></div>
                    <div class="flex items-center space-x-2 bg-white px-5 py-3 rounded-lg border border-gray-100 shadow-sm"><span>✅</span> <span>Selesai</span></div>
                </div>
            </section>

            <!-- CALL TO ACTION -->
            <section class="text-center py-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Sudah Siap Mengirim Pengaduan?</h2>
                <p class="text-xs text-gray-500 mb-6">Klik tombol di bawah untuk membuat laporan baru.</p>
                <div class="flex justify-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium text-sm transition shadow-lg">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <span>Buat Laporan</span>
                    </a>
                </div>
            </section>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#111a24] text-gray-400 text-sm pt-16 pb-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
            <div>
                <h4 class="text-white font-bold mb-4">Sistem Informasi Pengaduan Masyarakat</h4>
                <p class="text-xs leading-relaxed text-gray-400">Wadah bagi masyarakat untuk menyampaikan laporan, keluhan, atau aspirasi kepada Pemerintah Daerah.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="/tentang" class="hover:text-white transition">Tentang</a></li>
                    <li><a href="/cara_pengaduan" class="hover:text-white transition">Cara Pengaduan</a></li>
                    <li><a href="/kontak" class="hover:text-white transition">Kontak</a></li>
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