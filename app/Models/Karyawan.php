<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['nomor_induk', 'nama', 'alamat', 'tanggal_lahir', 'tanggal_bergabung'];

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'nomor_induk', 'nomor_induk');
    }

    public function getSisaCutiAttribute()
    {
        $cutiTerpakai = $this->cuti()->sum('lama_cuti');
        return 12 - $cutiTerpakai;
    }
}
