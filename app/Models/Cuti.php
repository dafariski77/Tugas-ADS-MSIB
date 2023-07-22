<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = ['nomor_induk', 'tanggal_cuti', 'lama_cuti', 'keterangan'];

    // Relasi ke tabel Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nomor_induk', 'nomor_induk');
    }
}
