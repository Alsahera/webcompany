<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Booking;
use App\Models\Pembayaran;
use App\Models\BuktiBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Halaman daftar kos (katalog publik)
     */
    public function index(Request $request)
    {
        $query = Kos::withCount('galeri', 'booking')->with('galeri');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kos', 'like', "%$search%")
                  ->orWhere('lokasi', 'like', "%$search%")
                  ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        // Filter harga
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        match ($sort) {
            'harga_asc'  => $query->orderBy('harga', 'asc'),
            'harga_desc' => $query->orderBy('harga', 'desc'),
            'nama'       => $query->orderBy('nama_kos', 'asc'),
            default      => $query->latest(),
        };

        $kosList      = $query->paginate(9)->withQueryString();
        $totalKos     = Kos::count();
        $hargaMin     = Kos::min('harga');
        $hargaMax     = Kos::max('harga');

        return view('client.kos', compact('kosList', 'totalKos', 'hargaMin', 'hargaMax'));
    }

    /**
     * Detail kos
     */
    public function show(Kos $ko)
    {
        $ko->load('galeri', 'booking');
        $kosLain = Kos::with('galeri')
            ->withCount('booking')
            ->where('id', '!=', $ko->id)
            ->latest()
            ->take(3)
            ->get();

        return view('client.kos-detail', compact('ko', 'kosLain'));
    }

    /**
     * Form booking (hanya untuk user yang login)
     */
    public function bookingForm(Kos $ko)
    {
        return view('client.booking-form', compact('ko'));
    }

    /**
     * Proses booking
     */
    public function bookingStore(Request $request, Kos $ko)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'durasi_sewa'   => 'required|integer|min:1|max:24',
        ], [
            'tanggal_masuk.required'       => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.after_or_equal' => 'Tanggal masuk tidak boleh di masa lalu.',
            'durasi_sewa.required'         => 'Durasi sewa wajib diisi.',
            'durasi_sewa.min'              => 'Minimal sewa 1 bulan.',
            'durasi_sewa.max'              => 'Maksimal sewa 24 bulan.',
        ]);

        $booking = Booking::create([
            'user_id'       => Auth::id(),
            'kos_id'        => $ko->id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'durasi_sewa'   => $request->durasi_sewa,
        ]);

        return redirect()->route('client.booking.success', $booking)
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Halaman sukses booking
     */
    public function bookingSuccess(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $booking->load('kos', 'pembayaran', 'buktiBayar');
        return view('client.booking-success', compact('booking'));
    }

    /**
     * Halaman riwayat booking user
     */
    public function myBookings()
    {
        $bookings = Booking::with('kos.galeri', 'pembayaran', 'buktiBayar')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('client.my-bookings', compact('bookings'));
    }

    /**
     * Upload bukti bayar oleh user
     */
    public function uploadBukti(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'file_bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'file_bukti.required' => 'File bukti wajib diunggah.',
            'file_bukti.image'    => 'File harus berupa gambar.',
            'file_bukti.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('file_bukti')->store('bukti_bayar', 'public');

        $bukti = $booking->buktiBayar;
        if ($bukti) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($bukti->file_bukti);
            $bukti->update(['file_bukti' => $path]);
        } else {
            BuktiBayar::create([
                'booking_id' => $booking->id,
                'file_bukti' => $path,
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }
}