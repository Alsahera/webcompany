<?php
// Letakkan file ini di: app/Http/Controllers/Api/KosApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;

class KosApiController extends Controller
{
    public function index()
    {
        $kos = Kos::withCount('galeri', 'booking')->latest()->get();
        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kos = Kos::create($data);
        return response()->json(['success' => true, 'data' => $kos], 201);
    }

    public function show(Kos $ko)
    {
        $ko->load('galeri', 'booking.user', 'booking.pembayaran');
        return response()->json(['success' => true, 'data' => $ko]);
    }

    public function update(Request $request, Kos $ko)
    {
        $data = $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $ko->update($data);
        return response()->json(['success' => true, 'data' => $ko]);
    }

    public function destroy(Kos $ko)
    {
        $ko->delete();
        return response()->json(['success' => true, 'message' => 'Kos berhasil dihapus.']);
    }
}