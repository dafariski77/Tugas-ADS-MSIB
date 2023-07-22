<?php

namespace App\Http\Controllers;

use App\Http\Resources\CutiResource;
use App\Models\Cuti;
use App\Http\Requests\StoreCutiRequest;
use App\Http\Requests\UpdateCutiRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuti = Cuti::all();
        return CutiResource::collection($cuti);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCutiRequest $request)
    {
        $validate = $request->validated();

        $cuti = Cuti::create($validate);
        return new CutiResource($cuti);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $cuti = Cuti::findOrFail($id);
            return new CutiResource($cuti);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Cuti not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCutiRequest $request, Cuti $cuti)
    {
        $validate = $request->validated();

        $cuti = Cuti::create($validate);
        return new CutiResource($cuti);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cuti = Cuti::findOrFail($id);
            $cuti->delete();
            return response()->json([
                "message" => "Data berhasil dihapus!"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Cuti not found.'], 404);
        }
    }
}
