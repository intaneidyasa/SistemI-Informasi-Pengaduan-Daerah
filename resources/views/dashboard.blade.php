<x-app-layout>
    <!-- Perbaikan CSS: Hanya menyembunyikan navbar bawaan Breeze asli, bukan sidebar kita -->
    <style>
        .min-h-screen > nav, [role="navigation"], header { display: none !important; }
        body, .min-h-screen { padding-top: 0 !important; margin-top: 0 !important; }
    </style>

    <div class="flex min-h-screen bg-[#f3f4f6] antialiased font-sans">
        
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-[#0a1931] text-slate-200 flex flex-col shrink-0 min-h-screen justify-between">
            <div>
                <div class="p-6">
                    <span class="font-bold text-xl text-white tracking-wide block">Pengaduan Daerah</span>
                </div>

                <!-- Menu Navigasi Atas -->
                <div class="mt-4 px-3 space-y-1">
                    <!-- 1. BERANDA -->
                    <a href="{{ url('/') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-house mr-3 w-5 text-center"></i>
                        <span>Beranda</span>
                    </a>

                    <!-- 2. STATISTIK  -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-[#3b82f6] text-white font-medium rounded-r-full -mr-3 transition text-[15px]">
                        <i class="fa-solid fa-chart-simple mr-3 w-5 text-center"></i>
                        <span>Statistik</span>
                    </a>

                    <!-- 3. BUAT LAPORAN -->
                    <a href="{{ route('pengaduan.create') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-file-pen mr-3 w-5 text-center"></i>
                        <span>Buat Laporan</span>
                    </a>

                    <!-- 4. RIWAYAT SAYA -->
                    <a href="{{ route('pengaduan.riwayat') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-center"></i>
                        <span>Riwayat Saya</span>
                    </a>
                </div>
            </div>

            <!-- BAGIAN BAWAH SIDEBAR -->
            <div class="p-4 border-t border-slate-800/60 bg-[#081426]">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-white/5 transition group">
                    <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm uppercase shrink-0">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate">Masyarakat</p>
                    </div>
                </a>
            </div>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <main class="flex-1 p-8 overflow-y-auto flex justify-center items-start">
            
            <div class="w-full max-w-[950px] bg-white rounded-2xl shadow-sm border border-slate-100 p-8 space-y-6 my-4">
                <div class="border-b border-blue-500 pb-3">
                    <h3 class="text-lg font-bold text-black tracking-wide">Informasi Layanan Pengaduan Masyarakat Daerah</h3>
                </div>
                
                <p class="text-slate-600 text-sm leading-relaxed">
                    Selamat datang di panel utama. Melalui portal resmi Pengaduan Daerah ini, Anda dapat menyampaikan aspirasi, keluhan, maupun laporan mengenai fasilitas dan pelayanan publik di daerah secara aman, transparan, dan cepat tanggap.
                </p>

                <!-- Statistik -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Laporan</div>
                        <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalLaporan }}</div>
                    </div>
                    <div class="bg-amber-50 p-4 rounded-xl border border-amber-100">
                        <div class="text-xs font-bold text-amber-600 uppercase tracking-wider">Sedang Diproses</div>
                        <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ $sedangDiproses }}</div>
                    </div>
                    <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100">
                        <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Selesai Ditangani</div>
                        <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ $selesaiDitangani }}</div>
                    </div>
                </div>

                <div class="pt-4 flex justify-start">
                    <a href="{{ route('pengaduan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg shadow-sm transition">
                        Mulai Buat Laporan Baru
                    </a>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>