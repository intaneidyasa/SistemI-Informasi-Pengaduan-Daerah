<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan; // Pastikan model Pengaduan sudah di-import

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        // Ambil data pengaduan dari database
        $pengaduan = Pengaduan::latest()->get(); 
        return view('admin.dashboard_admin', compact('pengaduan')); 
    }
}