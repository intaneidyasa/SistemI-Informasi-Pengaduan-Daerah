<x-app-layout>
    <div class="flex min-h-screen bg-slate-50 font-sans">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#0a1931] text-white flex flex-col p-6 shrink-0">
            <h1 class="text-xl font-bold mb-10">Portal PPKS</h1>
            
            <nav class="space-y-4 text-slate-300">
                <a href="{{ route('admin.pengaduan') }}" class="block hover:text-white">Data Pengaduan</a>
                <a href="{{ route('admin.users.index') }}" class="block bg-blue-500 text-white px-4 py-2 rounded-xl -mx-4">Manajemen User</a>
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
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h2>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    + Tambah User
                </button>
            </div>
            
            <!-- CARD TABLE -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-4">No</th>
                            <th class="px-4">Nama Lengkap</th>
                            <th class="px-4">Email</th>
                            <th class="px-4">Level</th>
                            <th class="px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @foreach($users as $index => $user)
                        <tr class="border-b border-slate-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 font-bold text-slate-800">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                    {{ $user->level == 'admin' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $user->level }}
                                </span>
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="#" class="bg-blue-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-blue-600">Edit</a>
                                <form action="#" method="POST">
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