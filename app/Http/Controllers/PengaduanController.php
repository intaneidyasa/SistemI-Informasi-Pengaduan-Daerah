<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\File; 
use App\Models\Pengaduan; 

class PengaduanController extends Controller
{
    // Dashboard User
public function index()
{
    $userId = auth()->id();
    
    $totalLaporan = Pengaduan::where('user_id', $userId)->count();
    
    // Logika: '0' atau 'pending' masuk ke 'Sedang Diproses'
    $sedangDiproses = Pengaduan::where('user_id', $userId)
        ->where(function($query) {
            $query->where('status', '0')
                  ->orWhereRaw('LOWER(status) = ?', ['pending'])
                  ->orWhereRaw('LOWER(status) = ?', ['proses']); // <--- Tambahkan ini
        })->count();

    // Logika: '1' atau 'selesai' masuk ke 'Selesai Ditangani'
    $selesaiDitangani = Pengaduan::where('user_id', $userId)
        ->where(function($query) {
            $query->where('status', '1')
                  ->orWhereRaw('LOWER(status) = ?', ['selesai']);
        })->count();

    return view('dashboard', compact('totalLaporan', 'sedangDiproses', 'selesaiDitangani'));
}
    
    // Form Buat Pengaduan
    public function create()
    {
        return view('pengaduan'); 
    }

    // Riwayat User
    public function riwayat()
    {
        $dataPengaduan = Pengaduan::where('user_id', auth()->id())
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('riwayat', ['pengaduan' => $dataPengaduan]); 
    }

    // Store Pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori_id'      => 'required',
            'lokasi'           => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'isi_laporan'      => 'required',
            'lampiran'         => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', 
        ]);

        try {
            $namaLampiran = null;
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $namaLampiran = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('lampiran'), $namaLampiran);
            }

            Pengaduan::create([
                'user_id'          => auth()->id(), 
                'judul'            => $request->judul,
                'kategori_id'      => $request->kategori_id,
                'lokasi'           => $request->lokasi,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'no_hp'            => $request->no_hp, 
                'isi_laporan'      => $request->isi_laporan,
                'lampiran'         => $namaLampiran,
                'status'           => '0', 
            ]);

            return redirect()->route('pengaduan.riwayat')->with('success', 'Pengaduan Anda berhasil dikirim!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // Detail User
    public function show($id)
    {
        $pengaduan = Pengaduan::where('user_id', auth()->id())->find($id);
        if (!$pengaduan) {
            return redirect()->route('pengaduan.riwayat')->with('error', 'Laporan tidak ditemukan.');
        }
        return view('detail_pengaduan', ['pengaduan' => $pengaduan]);
    }

    // Edit User
    public function edit($id)
    {
        $pengaduan = Pengaduan::where('user_id', auth()->id())->find($id);
        if (!$pengaduan || ($pengaduan->status !== '0' && $pengaduan->status !== 'Pending')) {
            return redirect()->route('pengaduan.riwayat')->with('error', 'Laporan tidak bisa diubah.');
        }
        return view('edit_pengaduan', compact('pengaduan'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori_id'      => 'required',
            'lokasi'           => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'isi_laporan'      => 'required',
            'lampiran'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', 
        ]);

        $pengaduan = Pengaduan::where('user_id', auth()->id())->find($id);

        if (!$pengaduan || ($pengaduan->status !== '0' && $pengaduan->status !== 'Pending')) {
            return redirect()->route('pengaduan.riwayat')->with('error', 'Akses ditolak.');
        }

        try {
            $namaLampiran = $pengaduan->lampiran;
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $namaLampiran = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('lampiran'), $namaLampiran);

                if ($pengaduan->lampiran && File::exists(public_path('lampiran/' . $pengaduan->lampiran))) {
                    File::delete(public_path('lampiran/' . $pengaduan->lampiran));
                }
            }

            $pengaduan->update([
                'judul'            => $request->judul,
                'kategori_id'      => $request->kategori_id,
                'lokasi'           => $request->lokasi,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'no_hp'            => $request->no_hp, 
                'isi_laporan'      => $request->isi_laporan,
                'lampiran'         => $namaLampiran,
            ]);

            return redirect()->route('pengaduan.riwayat')->with('success', 'Pengaduan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // Admin List
    public function adminIndex()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard_admin', compact('pengaduan'));
    }

    // Admin Edit View
    public function adminEdit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.edit', compact('pengaduan'));
    }

    // 10. Admin Update 
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,proses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        
        $pengaduan->status = $request->status;
        $pengaduan->tanggapan = $request->tanggapan;
        $pengaduan->save();

        // Mengarahkan ke route dashboard admin 
        return redirect()->route('admin.dashboard_admin')->with('success', 'Data berhasil diperbarui dan kembali ke dashboard.');
    }

    // 11. Admin Destroy
    public function adminDestroyPengaduan($id)
    {
        $pengaduan = Pengaduan::find($id);
        if ($pengaduan) {
            if (File::exists(public_path('lampiran/' . $pengaduan->lampiran))) {
                File::delete(public_path('lampiran/' . $pengaduan->lampiran));
            }
            $pengaduan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}