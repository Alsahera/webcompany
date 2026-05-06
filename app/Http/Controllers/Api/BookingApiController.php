<?php
// Letakkan file ini di: app/Http/Controllers/Api/BookingApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function index()
    {
        $booking = Booking::with('kos', 'user', 'pembayaran')->latest()->get();
        return response()->json(['success' => true, 'data' => $booking]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'kos_id'        => 'required|exists:kos,id',
            'tanggal_masuk' => 'required|date',
            'durasi_sewa'   => 'required|integer|min:1|max:24',
        ]);

        $booking = Booking::create($data);
        $booking->load('kos', 'user');
        return response()->json(['success' => true, 'data' => $booking], 201);
    }

    public function show(Booking $booking)
    {
        $booking->load('kos', 'user', 'pembayaran', 'buktiBayar');
        return response()->json(['success' => true, 'data' => $booking]);
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'kos_id'        => 'required|exists:kos,id',
            'tanggal_masuk' => 'required|date',
            'durasi_sewa'   => 'required|integer|min:1|max:24',
        ]);

        $booking->update($data);
        $booking->load('kos', 'user');
        return response()->json(['success' => true, 'data' => $booking]);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['success' => true, 'message' => 'Booking berhasil dihapus.']);
    }
}