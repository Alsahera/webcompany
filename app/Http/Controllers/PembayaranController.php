<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\BuktiBayar;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('booking.kos', 'booking.user', 'booking.buktiBayar')
            ->latest()->paginate(10);
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        // Hanya booking yang belum punya pembayaran
        $bookingList = Booking::with('kos', 'user')
            ->whereDoesntHave('pembayaran')
            ->latest()->get();
        return view('pembayaran.create', compact('bookingList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id'    => 'required|exists:booking,id|unique:pembayaran,booking_id',
            'total_tagihan' => 'required|numeric|min:0',
            'status_bayar'  => 'required|in:pending,lunas',
            'metode_bayar'  => 'required|in:Mandiri,BCA,Dana',
            'file_bukti'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'booking_id.required'  => 'Pilih booking.',
            'booking_id.unique'    => 'Booking ini sudah memiliki data pembayaran.',
            'total_tagihan.required' => 'Total tagihan wajib diisi.',
            'total_tagihan.numeric' => 'Total tagihan harus berupa angka.',
            'status_bayar.required' => 'Status bayar wajib dipilih.',
            'metode_bayar.required' => 'Metode bayar wajib dipilih.',
            'file_bukti.image'      => 'File bukti harus berupa gambar.',
            'file_bukti.max'        => 'Ukuran file maksimal 2MB.',
        ]);

        $pembayaran = Pembayaran::create($request->only(
            'booking_id', 'total_tagihan', 'status_bayar', 'metode_bayar'
        ));

        // Upload bukti bayar jika ada
        if ($request->hasFile('file_bukti')) {
            $path = $request->file('file_bukti')->store('bukti_bayar', 'public');
            BuktiBayar::create([
                'booking_id' => $request->booking_id,
                'file_bukti' => $path,
            ]);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('booking.kos', 'booking.user', 'booking.buktiBayar');
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load('booking.kos', 'booking.user', 'booking.buktiBayar');
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'total_tagihan' => 'required|numeric|min:0',
            'status_bayar'  => 'required|in:pending,lunas',
            'metode_bayar'  => 'required|in:Mandiri,BCA,Dana',
            'file_bukti'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayaran->update($request->only('total_tagihan', 'status_bayar', 'metode_bayar'));

        // Update bukti bayar jika ada file baru
        if ($request->hasFile('file_bukti')) {
            $buktiBayar = $pembayaran->booking->buktiBayar;

            if ($buktiBayar) {
                Storage::disk('public')->delete($buktiBayar->file_bukti);
                $buktiBayar->update([
                    'file_bukti' => $request->file('file_bukti')->store('bukti_bayar', 'public'),
                ]);
            } else {
                BuktiBayar::create([
                    'booking_id' => $pembayaran->booking_id,
                    'file_bukti' => $request->file('file_bukti')->store('bukti_bayar', 'public'),
                ]);
            }
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        // Hapus bukti bayar terkait
        $buktiBayar = $pembayaran->booking->buktiBayar ?? null;
        if ($buktiBayar) {
            Storage::disk('public')->delete($buktiBayar->file_bukti);
            $buktiBayar->delete();
        }

        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }
}