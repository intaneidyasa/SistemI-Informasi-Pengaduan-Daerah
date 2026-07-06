<x-app-layout>
    <div class="flex min-h-screen bg-slate-50 font-sans">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#0a1931] text-white flex flex-col p-6 shrink-0">
            <h1 class="text-xl font-bold mb-10">Pengaduan Daerah</h1>
            
            <nav class="space-y-4 text-slate-300">
                <a href="#" class="block bg-blue-500 text-white px-4 py-2 rounded-xl -mx-4">Data Pengaduan</a>
                <a href="{{ route('admin.users.index') }}" class="block hover:text-white">Manajemen User</a>
            </nav>

            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 font-bold hover:text-red-300">Logout</button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-10">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Daftar Masuk Pengaduan</h2>
            
            <!-- CARD TABLE -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-4">No</th>
                            <th class="px-4">Pelapor</th>
                            <th class="px-4">Deskripsi</th>
                            <th class="px-4">Bukti</th>
                            <th class="px-4">Status</th>
                            <th class="px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @foreach($pengaduan as $index => $item)
                        <tr class="border-b border-slate-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 font-bold">{{ $item->user->name }}</td>
                            <td class="px-4 py-2">{{ $item->isi_laporan }}</td>
                            <td class="px-4 py-2">
                               <a href="{{ asset('lampiran/' . $item->lampiran) }}" target="_blank" class="text-blue-600 underline">Lihat Bukti</a>
                            </td>
                            <td class="px-4 py-2">
                                @if($item->status == 0)
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-orange-100 text-orange-600">MENUNGGU</span>
                                @elseif($item->status == 1)
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-600">SELESAI</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-600">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.pengaduan.edit', $item->id) }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-blue-600">
                                   Edit
                                </a>
                                
                                <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>