<x-app-layout>
    <style>
        .min-h-screen > nav, [role="navigation"], header { display: none !important; }
        body, .min-h-screen { padding-top: 0 !important; margin-top: 0 !important; }
    </style>

    <div class="flex min-h-screen bg-[#f3f4f6] antialiased font-sans">
        
        <aside class="w-64 bg-[#0a1931] text-slate-200 flex flex-col shrink-0 min-h-screen justify-between">
            <div>
                <div class="p-6">
                    <span class="font-bold text-xl text-white tracking-wide block">Pengaduan Daerah</span>
                </div>

                <div class="mt-4 px-3 space-y-1">
                    <a href="{{ url('/') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-house mr-3 w-5 text-center"></i>
                        <span>Beranda</span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-chart-simple mr-3 w-5 text-center"></i>
                        <span>Statistik</span>
                    </a>

                    <a href="{{ route('pengaduan.create') }}" class="flex items-center px-4 py-3 text-slate-400 hover:text-white rounded-lg transition text-[15px]">
                        <i class="fa-solid fa-file-pen mr-3 w-5 text-center"></i>
                        <span>Buat Laporan</span>
                    </a>

                    <a href="{{ route('pengaduan.riwayat') }}" class="flex items-center px-4 py-3 bg-[#3b82f6] text-white font-medium rounded-r-full -mr-3 transition text-[15px]">
                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-center"></i>
                        <span>Riwayat Saya</span>
                    </a>
                </div>
            </div>

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

        <main class="flex-1 p-8 overflow-y-auto flex justify-center items-start">
            
            <div class="w-full max-w-5xl my-4 space-y-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Riwayat Pengaduan Anda</h2>
                        <p class="text-sm text-slate-500 mt-1">Pantau perkembangan status laporan aspirasi atau keluhan yang telah Anda kirimkan.</p>
                    </div>
                    <div class="mt-3 md:mt-0">
                        <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 transition shadow-md">
                            + Buat Laporan Baru
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 uppercase tracking-wider text-[11px] font-bold">
                    <th class="py-4 px-6 w-16 text-center">No</th>
                    <th class="py-4 px-6">Judul Laporan</th>
                    <th class="py-4 px-6">Kategori</th>
                    <th class="py-4 px-6">Tanggal</th>
                    <th class="py-4 px-6 text-center">Status</th>
                    <th class="py-4 px-6 text-center">Tanggapan</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-600 divide-y divide-slate-100">
                @forelse ($pengaduan as $index => $item)
                    @php $status = strtolower($item->status); @endphp
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-slate-800 max-w-xs truncate">{{ $item->judul }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-md">
                                {{ $item->kategori_id ?? 'Umum' }} 
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d M Y') }}
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($status == '0' || $status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Pending</span>
                            @elseif($status == '1' || $status == 'proses')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Proses</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Selesai</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500 max-w-[150px] truncate text-center">
                            {{ $item->tanggapan ?? '-' }}
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('pengaduan.show', $item->id) }}" class="inline-block px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold text-xs rounded-lg transition">Detail</a>
                                @if($status == '0' || $status == 'pending')
                                    <a href="{{ route('pengaduan.edit', $item->id) }}" class="inline-block px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 font-bold text-xs rounded-lg transition">Edit</a>
                                @endif
                            </div>
                        </td>
                    </tr> 
                @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-4 bg-slate-50 rounded-full border border-slate-100 text-slate-300">
                                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="font-bold text-slate-700 text-base">Belum Ada Riwayat Pengaduan</p>
                            </div>
                        </td>
                    </tr> 
                @endforelse
            </tbody>
        </table>
    </div>
</div>

        </main>
    </div>
</x-app-layout>