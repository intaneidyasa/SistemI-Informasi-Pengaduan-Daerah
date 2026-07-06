<x-app-layout>
    <div class="p-10">
        <h2 class="text-2xl font-bold mb-6">Edit Status Pengaduan</h2>

        <!-- 1. Menampilkan Pesan Sukses -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- 2. Menampilkan Pesan Error ) -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm">
            @csrf 
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700">Status</label>
                <select name="status" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="0" {{ old('status', $pengaduan->status) == '0' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ old('status', $pengaduan->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700">Tanggapan Admin</label>
                <textarea name="tanggapan" rows="4" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
            </div>
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-app-layout>