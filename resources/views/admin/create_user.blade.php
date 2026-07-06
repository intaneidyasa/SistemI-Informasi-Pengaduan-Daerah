<x-app-layout>
    <div class="p-10">
        <h2 class="text-2xl font-bold mb-6">Tambah User Baru</h2>
        
        <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded shadow-sm border">
            @csrf
            
            <div class="mb-4">
                <label class="block font-bold">Nama</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-4">
                <label class="block font-bold">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-4">
                <label class="block font-bold">Level</label>
                <select name="role" class="w-full border p-2 rounded" required>
                    <option value="admin">Admin</option>
                    <option value="masyarakat">Masyarakat</option>
                </select>
            </div>
            
            <button type="submit" class="bg-[#0a1931] text-white px-6 py-2 rounded-lg font-bold hover:bg-slate-800">
                Simpan User
            </button>
        </form>
    </div>
</x-app-layout>