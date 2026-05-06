<?php
// Letakkan file ini di: app/Http/Controllers/Api/PembayaranApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;

class PembayaranApiController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('booking.kos', 'booking.user')->latest()->get();
        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id'    => 'required|exists:booking,id|unique:pembayaran,booking_id',
            'total_tagihan' => 'required|numeric|min:0',
            'status_bayar'  => 'required|in:pending,lunas',
            'metode_bayar'  => 'required|in:Mandiri,BCA,Dana',
        ]);

        $pembayaran = Pembayaran::create($data);
        $pembayaran->load('booking.kos', 'booking.user');
        return response()->json(['success' => true, 'data' => $pembayaran], 201);
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('booking.kos', 'booking.user', 'booking.buktiBayar');
        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate([
            'total_tagihan' => 'required|numeric|min:0',
            'status_bayar'  => 'required|in:pending,lunas',
            'metode_bayar'  => 'required|in:Mandiri,BCA,Dana',
        ]);

        $pembayaran->update($data);
        $pembayaran->load('booking.kos', 'booking.user');
        return response()->json(['success' => true, 'data' => $pembayaran]);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dihapus.']);
    }
}