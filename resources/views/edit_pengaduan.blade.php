<x-app-layout>
    <!-- CSS Khusus untuk Menyembunyikan Navbar Breeze & Menghias Input File -->
    <style>
        .min-h-screen > nav, [role="navigation"], header { display: none !important; }
        body, .min-h-screen { padding-top: 0 !important; margin-top: 0 !important; }

        input[type="file"]::-webkit-file-upload-button {
            border: 1px solid #d1d5db; 
            border-radius: 6px;
            background-color: #f3f4f6; 
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 500;
            color: #374151; 
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 10px;
        }
        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #e5e7eb; 
        }
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

                    <!-- 4. RIWAYAT SAYA  -->
                    <a href="{{ route('pengaduan.riwayat') }}" class="flex items-center px-4 py-3 bg-[#3b82f6] text-white font-medium rounded-r-full -mr-3 transition text-[15px]">
                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-center"></i>
                        <span>Riwayat Saya</span>
                    </a>
                </div>
            </div>

            <!-- BAGIAN BAWAH SIDEBAR  -->
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

        <!-- AREA KONTEN UTAMA (Sisi Kanan) -->
        <main class="flex-1 p-8 overflow-y-auto flex justify-center items-start">
            
            <div class="w-full max-w-4xl my-4 space-y-4">
                
                <!-- Alert Gagal -->
                @if(session('error'))
                    <div class="p-4 mb-2 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Card Utama Form -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-slate-200">

                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-7 py-5 flex items-center shadow-md">
                        <div class="p-2 bg-white/10 rounded-lg mr-3.5">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white uppercase tracking-wider drop-shadow-sm">
                            Edit Pengaduan Masyarakat
                        </h3>
                    </div>

                    <!-- Isi Form Utama -->
                    <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-7">
                        @csrf
                        @method('PUT')

                        <!-- Judul Pengaduan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Judul Pengaduan</label>
                            <input type="text" name="judul" value="{{ old('judul', $pengaduan->judul) }}" required placeholder="Contoh : Jalan Raya Ahmad Yani Berlubang" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-3 px-4">
                            @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Kategori & Lokasi Kejadian  -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Kategori</label>
                                <select name="kategori_id" required 
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-3 px-4">
                                    <option value="" disabled>-- Pilih Kategori --</option>
                                    <option value="Infrastruktur" {{ old('kategori_id', $pengaduan->kategori_id) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur & Jalanan</option>
                                    <option value="Fasilitas Umum" {{ old('kategori_id', $pengaduan->kategori_id) == 'Fasilitas Umum' || old('kategori_id', $pengaduan->kategori_id) == 'Fasilitas Publik' ? 'selected' : '' }}>Fasilitas Umum</option>
                                    <option value="Kesehatan" {{ old('kategori_id', $pengaduan->kategori_id) == 'Kesehatan' ? 'selected' : '' }}>Layanan Kesehatan</option>
                                    <option value="Keamanan" {{ old('kategori_id', $pengaduan->kategori_id) == 'Keamanan' ? 'selected' : '' }}>Ketertiban & Keamanan</option>
                                    <option value="Lainnya" {{ old('kategori_id', $pengaduan->kategori_id) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Lokasi Kejadian</label>
                                <input type="text" name="lokasi" value="{{ old('lokasi', $pengaduan->lokasi) }}" required placeholder="Nama Jalan / Desa / Kecamatan" 
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-3 px-4">
                                @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Tanggal Kejadian & Nomor HP -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Tanggal Kejadian</label>
                                <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('Y-m-d')) }}" required 
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-3 px-4">
                                @error('tanggal_kejadian') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Nomor HP Aktif</label>
                                <input type="tel" name="no_hp" value="{{ old('no_hp', $pengaduan->no_hp ?? '') }}" required placeholder="Contoh : 0812XXXXXXXX" 
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-3 px-4">
                                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Isi Pengaduan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Contoh Kronologi / Isi Pengaduan</label>
                            <textarea name="isi_laporan" rows="6" required placeholder="Tuliskan kronologi kejadian secara lengkap..." 
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm p-4">{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>
                            @error('isi_laporan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Upload Bukti Lampiran -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Perbarui Bukti Lampiran (Semua Tipe)</label>
                            
                            <!-- Box Tampilan Info Berkas -->
                            @if($pengaduan->lampiran)
                                <div class="mb-3 p-3.5 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-between text-xs text-blue-800">
                                    <span class="truncate max-w-md flex items-center">
                                        <i class="fa-solid fa-file-lines mr-2 text-blue-500 text-sm"></i>
                                        File saat ini:&nbsp;<strong class="text-blue-900 truncate">{{ $pengaduan->lampiran }}</strong>
                                    </span>
                                    <a href="{{ route('pengaduan.file', $pengaduan->lampiran) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline font-bold shrink-0 ml-2">
                                        Lihat File
                                    </a>
                                </div>
                            @endif

                            <div class="mt-1.5 p-5 border border-gray-200 rounded-xl bg-gray-50 flex items-center shadow-inner">
                                <svg class="w-5 h-5 text-gray-400 mr-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
 
                                <input type="file" name="lampiran" class="text-sm text-gray-600 focus:outline-none focus:ring-0">
                            </div>
                            <p class="text-xs text-gray-500 mt-2 ml-1">Kosongkan jika tidak ingin mengubah berkas. Format: JPG, PNG, MP4, PDF, DOCX (Maks. 10MB)</p>
                            @error('lampiran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Checkbox Syarat -->
                        <div class="flex items-center mt-3 ml-1">
                            <input id="pernyataan" name="pernyataan" type="checkbox" required checked
                                   class="focus:ring-blue-500 h-5 w-5 text-blue-600 border-gray-300 rounded shadow-sm cursor-pointer">
                            <label for="pernyataan" class="ml-3 text-sm font-medium text-gray-700 cursor-pointer">Saya menyatakan bahwa perubahan laporan ini benar dan dapat dipertanggungjawabkan.</label>
                        </div>

                        <hr class="border-gray-200">

                        <!-- Tombol Aksi Akhir -->
                        <div class="flex items-center space-x-3 justify-start pt-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('pengaduan.riwayat') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-500 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-600 active:bg-gray-700 focus:outline-none transition ease-in-out duration-150 shadow-md">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>