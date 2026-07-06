<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - Sistem Informasi Pengaduan Masyarakat</title>
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
                    <a href="{{ url('/cara_pengaduan') }}" class="text-gray-300 hover:text-white transition">Cara Pengaduan</a>
                    <a href="{{ url('/kontak') }}" class="border-b-2 border-white pb-1 font-semibold">Kontak</a>
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
    <header class="bg-gradient-to-r from-[#162a45] via-[#1d4ed8] to-[#2563eb] text-white py-12 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-1 tracking-wide">Kontak Kami</h1>
            <p class="text-sm text-blue-100">Hubungi kami apabila membutuhkan bantuan atau informasi lebih lanjut.</p>
        </div>
    </header>

    <main class="flex-grow max-w-3xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-16 flex flex-col justify-center">
        
        <div class="bg-white p-8 md:p-10 rounded-xl border border-gray-200/70 shadow-sm">
            <h2 class="font-bold text-slate-800 text-lg mb-6 border-b border-gray-100 pb-3">Informasi Kontak</h2>
            
            <div class="space-y-6 text-sm md:text-base text-gray-600">
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-50 p-2.5 rounded-lg text-blue-600">
                        <i class="fa-solid fa-location-dot text-lg w-5 text-center"></i>
                    </div>
                    <div class="pt-1">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Alamat Kantor</p>
                        <span class="text-slate-700">Jl. Pemerintahan No. 1, Kota Anda</span>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-50 p-2.5 rounded-lg text-blue-600">
                        <i class="fa-solid fa-phone text-lg w-5 text-center"></i>
                    </div>
                    <div class="pt-1">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Nomor Telepon / Fax</p>
                        <span class="text-slate-700">(0717) 000-0000</span>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-50 p-2.5 rounded-lg text-blue-600">
                        <i class="fa-solid fa-envelope text-lg w-5 text-center"></i>
                    </div>
                    <div class="pt-1">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Surat Elektronik (E-mail)</p>
                        <a href="mailto:pengaduan@pemda.go.id" class="text-blue-600 hover:underline font-medium">pengaduan@pemda.go.id</a>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-50 p-2.5 rounded-lg text-blue-600">
                        <i class="fa-solid fa-clock text-lg w-5 text-center"></i>
                    </div>
                    <div class="pt-1">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Jam Operasional Pelayanan</p>
                        <span class="text-slate-700">Senin – Jumat, 08.00 – 16.00 WIB</span>
                    </div>
                </div>
            </div>
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