<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CutiResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_induk' => $this->nomor_induk,
            'tanggal_cuti' => $this->tanggal_cuti,
            'lama_cuti' => $this->lama_cuti,
            'keterangan' => $this->keterangan,
            'karyawan' => new KaryawanResource($this->karyawan),
        ];
    }
}
