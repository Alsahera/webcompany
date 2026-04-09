<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('kos')->latest()->paginate(12);
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        $kosList = Kos::orderBy('nama_kos')->get();
        return view('galeri.create', compact('kosList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'foto'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'kos_id.required' => 'Pilih kos terlebih dahulu.',
            'kos_id.exists'   => 'Kos tidak ditemukan.',
            'foto.required'   => 'Foto wajib diunggah.',
            'foto.image'      => 'File harus berupa gambar.',
            'foto.mimes'      => 'Format gambar: jpg, jpeg, png, webp.',
            'foto.max'        => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'kos_id' => $request->kos_id,
            'foto'   => $path,
        ]);

        return redirect()->route('galeri.index')
            ->with('success', 'Foto berhasil diunggah.');
    }

    public function show(Galeri $galeri)
    {
        $galeri->load('kos');
        return view('galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        $kosList = Kos::orderBy('nama_kos')->get();
        return view('galeri.edit', compact('galeri', 'kosList'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = ['kos_id' => $request->kos_id];

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete($galeri->foto);
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return redirect()->route('galeri.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}