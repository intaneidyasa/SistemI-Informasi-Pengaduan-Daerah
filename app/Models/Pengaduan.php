<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id', 
        'judul',
        'kategori_id',
        'lokasi',
        'tanggal_kejadian',
        'no_hp',
        'isi_laporan',
        'lampiran',
        'status',
        'tanggapan', 
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}