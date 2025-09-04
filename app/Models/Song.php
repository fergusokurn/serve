<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_petugas',
        'nama_pic',
        'nomor_telp',
        'tanggal_tugas',
        'waktu_tugas',
        'judul_lagu',
        'sumber_lagu',
        'teks_lagu',
        'judul_lagu_pembuka',
        'sumber_lagu_pembuka',
        'teks_lagu_pembuka',
        'judul_lagu_persembahan',
        'sumber_lagu_persembahan',
        'teks_lagu_persembahan',
        'judul_lagu_komuni',
        'sumber_lagu_komuni',
        'teks_lagu_komuni',
        'judul_lagu_penutup',
        'sumber_lagu_penutup',
        'teks_lagu_penutup',
        'tuhan_kasihanilah',
        'kemuliaan',
        'kudus',
        'anamnesis',
        'bapa_kami',
        'anak_domba_allah',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_tugas' => 'date',
        'waktu_tugas' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
