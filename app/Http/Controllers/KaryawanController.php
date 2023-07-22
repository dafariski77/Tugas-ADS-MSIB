<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Http\Resources\KaryawanResource;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return KaryawanResource::collection($karyawan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        $validate = $request->validated();
        $karyawan = Karyawan::create($validate);

        return new KaryawanResource($karyawan);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            return new KaryawanResource($karyawan);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Karyawan not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryawanRequest $request, Karyawan $karyawan)
    {
        $validate = $request->validated();

        $karyawan->update($validate);
        return new KaryawanResource($karyawan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            $karyawan->delete();
            return response()->json([
                "message" => "Data berhasil dihapus!"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Karyawan not found.'], 404);
        }
    }

    public function firstThreeKaryawan()
    {
        $karyawan =  Karyawan::orderBy('tanggal_bergabung')->take(3)->get();
        return KaryawanResource::collection($karyawan);
    }

    public function karyawanWithCuti()
    {
        $karyawan = Karyawan::has('cuti')->get();
        return KaryawanResource::collection($karyawan);
    }

    public function sisaCutiKaryawan()
    {
        $karyawan = Karyawan::all();
        $karyawanResources = $karyawan->map(function ($item) {
            return [
                'nomor_induk' => $item->nomor_induk,
                'nama' => $item->nama,
                'sisa_cuti' => $item->sisa_cuti,
            ];
        });
    
        return response()->json(['data' => $karyawanResources]);
    }
}
