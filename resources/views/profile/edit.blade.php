<x-app-layout>
    <!-- CSS untuk mereset layout agar memenuhi layar penuh -->
    <style>
        .min-h-screen > nav, [role="navigation"], header { display: none !important; }
        body, .min-h-screen { padding-top: 0 !important; margin-top: 0 !important; }
    </style>

    <div class="min-h-screen bg-[#f3f4f6] antialiased font-sans p-8">
        
        <!-- AREA KONTEN UTAMA -->
        <main class="max-w-4xl mx-auto space-y-7">
            
            <!-- Navigasi Kembali -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center text-slate-500 hover:text-blue-600 transition font-medium text-sm group">
                    <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Header Halaman -->
            <div class="border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-slate-800">Pengaturan Akun</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola informasi profil, amankan kata sandi, atau atur preferensi akun Anda di sini.</p>
            </div>

            <!-- SEKSYEN 1: Informasi Profil -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200 rounded-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- SEKSYEN 2: Ubah Kata Sandi -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200 rounded-2xl">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Keamanan Sandi</h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- SEKSYEN 3: Hapus Akun -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200 rounded-2xl border-l-4 border-l-red-500">
                <h3 class="text-lg font-bold text-red-700 mb-4">Hapus Akun</h3>
                @include('profile.partials.delete-user-form')
            </div>

        </main>
    </div>
</x-app-layout>