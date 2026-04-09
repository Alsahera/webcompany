<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::with('kos', 'user', 'pembayaran')->latest()->paginate(10);
        return view('booking.index', compact('booking'));
    }

    public function create()
    {
        $kosList  = Kos::orderBy('nama_kos')->get();
        $userList = User::orderBy('name')->get();
        return view('booking.create', compact('kosList', 'userList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'kos_id'        => 'required|exists:kos,id',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'durasi_sewa'   => 'required|integer|min:1|max:24',
        ], [
            'user_id.required'       => 'Pilih penyewa.',
            'kos_id.required'        => 'Pilih kos.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date'     => 'Format tanggal tidak valid.',
            'tanggal_masuk.after_or_equal' => 'Tanggal masuk tidak boleh di masa lalu.',
            'durasi_sewa.required'   => 'Durasi sewa wajib diisi.',
            'durasi_sewa.min'        => 'Minimal sewa 1 bulan.',
            'durasi_sewa.max'        => 'Maksimal sewa 24 bulan.',
        ]);

        Booking::create($request->only('user_id', 'kos_id', 'tanggal_masuk', 'durasi_sewa'));

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show(Booking $booking)
    {
        $booking->load('kos', 'user', 'pembayaran', 'buktiBayar');
        return view('booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $kosList  = Kos::orderBy('nama_kos')->get();
        $userList = User::orderBy('name')->get();
        return view('booking.edit', compact('booking', 'kosList', 'userList'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'kos_id'        => 'required|exists:kos,id',
            'tanggal_masuk' => 'required|date',
            'durasi_sewa'   => 'required|integer|min:1|max:24',
        ]);

        $booking->update($request->only('user_id', 'kos_id', 'tanggal_masuk', 'durasi_sewa'));

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}