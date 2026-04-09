<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::withCount('galeri', 'booking')->latest()->paginate(10);
        return view('kos.index', compact('kos'));
    }

    public function create()
    {
        return view('kos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_kos.required' => 'Nama kos wajib diisi.',
            'harga.required'    => 'Harga wajib diisi.',
            'harga.numeric'     => 'Harga harus berupa angka.',
            'lokasi.required'   => 'Lokasi wajib diisi.',
        ]);

        Kos::create($request->only('nama_kos', 'harga', 'lokasi', 'deskripsi'));

        return redirect()->route('kos.index')
            ->with('success', 'Data kos berhasil ditambahkan.');
    }

    // Variabel diganti ke $ko karena di route:list terdeteksi {ko}
    public function show(Kos $ko)
    {
        $ko->load('galeri', 'booking.pembayaran', 'booking.user');
        // Tetap kirim ke view dengan nama 'kos' agar file Blade kamu tidak perlu diubah
        return view('kos.show', ['kos' => $ko]);
    }

    public function edit(Kos $ko)
    {
        return view('kos.edit', ['kos' => $ko]);
    }

    public function update(Request $request, Kos $ko)
    {
        $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $ko->update($request->only('nama_kos', 'harga', 'lokasi', 'deskripsi'));

        return redirect()->route('kos.index')
            ->with('success', 'Data kos berhasil diperbarui.');
    }

    public function destroy(Kos $ko)
    {
        $ko->delete();
        return redirect()->route('kos.index')
            ->with('success', 'Data kos berhasil dihapus.');
    }
}