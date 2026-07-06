<x-app-layout>
    <div class="p-10">
        <h2 class="text-2xl font-bold mb-6">Edit User</h2>
        
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow-sm">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2 rounded">
            </div>
            
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2 rounded">
            </div>
            
            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="masyarakat" {{ $user->role === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                </select>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout>