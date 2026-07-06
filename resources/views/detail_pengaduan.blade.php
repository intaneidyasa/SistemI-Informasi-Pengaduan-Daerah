<x-app-layout>
    <!-- CSS Khusus untuk Menyembuyenkan Navbar Breeze -->
    <style>
        .min-h-screen > nav, [role="navigation"], header { display: none !important; }
        body, .min-h-screen { padding-top: 0 !important; margin-top: 0 !important; }
    </style>

    <div class="flex min-h-screen bg-[#f3f4f6] antialiased font-sans">
        
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-[#0a1931] text-slate-200 flex flex-col shrink-0 min-h-screen justify-between">
            <div>
                <!-- Brand Header -->
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

                    <!-- 2. STATISTIK -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-chart-simple mr-3 w-5 text-center"></i>
                        <span>Statistik</span>
                    </a>

                    <!-- 3. BUAT LAPORAN -->
                    <a href="{{ route('pengaduan.create') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-file-pen mr-3 w-5 text-center"></i>
                        <span>Buat Laporan</span>
                    </a>

                    <!-- 4. RIWAYAT SAYA -->
                    <a href="{{ route('pengaduan.riwayat') }}" class="flex items-center px-4 py-3 bg-[#3b82f6] text-white font-medium rounded-r-full -mr-3 transition text-[15px]">
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
            <div class="w-full max-w-3xl my-4 bg-white rounded-2xl shadow-sm border border-slate-200 p-8 space-y-6">
                
                <!-- Header Card Detail -->
                <div class="flex justify-between items-start pb-2">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">
                            {{ $pengaduan->kategori_id ?? 'Umum' }}
                        </span>
                        <h2 class="text-2xl font-bold text-[#0a1931] mt-3">{{ $pengaduan->judul }}</h2>
                    </div>
                    <a href="{{ route('pengaduan.riwayat') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition">← Kembali ke Riwayat</a>
                </div>

                <!-- Info Grid Data Pengaduan (Diselaraskan dengan Format Input Form) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-4 text-sm bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <div>
                        <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Lokasi Kejadian</p>
                        <p class="font-bold text-slate-700 mt-1">{{ $pengaduan->lokasi }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Tanggal Kejadian</p>
                        <p class="font-bold text-slate-700 mt-1">
                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Kategori Laporan</p>
                        <p class="font-bold text-slate-700 mt-1">{{ $pengaduan->kategori_id ?? 'Umum' }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Nomor HP Aktif</p>
                        <p class="font-bold text-slate-700 mt-1">{{ $pengaduan->no_hp ?? '-' }}</p>
                    </div>
                </div>

                <!-- Isi Laporan -->
                <div>
                    <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider mb-2">Contoh Kronologi / Isi Pengaduan</p>
                    <div class="text-slate-700 whitespace-pre-line leading-relaxed bg-slate-50/50 p-5 rounded-xl border border-slate-100/70 min-h-[100px]">
                        {{ $pengaduan->isi_laporan }}
                    </div>
                </div>

                <!-- BAGIAN LAMPIRAN -->
                @if($pengaduan->lampiran)
                <div>
                    <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wider mb-2">Berkas Lampiran / Bukti</p>
                    <div class="mt-2 border border-slate-200 rounded-xl overflow-hidden shadow-sm bg-slate-50">
                        @php
                            $ekstensi = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array(strtolower($ekstensi), ['jpg', 'jpeg', 'png']))
                            <!-- Jika Gambar -->
                            <div class="p-4 flex justify-center bg-white">
                                <img src="{{ route('pengaduan.file', $pengaduan->lampiran) }}" alt="Lampiran Pengaduan" class="max-w-full h-auto max-h-[500px] rounded-lg">
                            </div>
                        @elseif(strtolower($ekstensi) === 'pdf')
                            <!-- Jika PDF -->
                            <iframe src="{{ route('pengaduan.file', $pengaduan->lampiran) }}" class="w-full h-[600px] border-0" allow="autoplay"></iframe>
                        @else
                            <!-- Format Lainnya -->
                            <div class="p-6 text-center text-slate-500 text-sm">
                                <p class="font-semibold">Format berkas (.{{ $ekstensi }}) tidak mendukung pratinjau langsung.</p>
                                <a href="{{ route('pengaduan.file', $pengaduan->lampiran) }}" target="_blank" class="mt-3 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition">
                                    Buka di Tab Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
                
            </div>
        </main>
    </div>
</x-app-layout>