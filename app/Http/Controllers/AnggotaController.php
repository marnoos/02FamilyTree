<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::with(['ayah', 'ibu']);

        // Sekarang variabel $request di bawah ini bisa dikenali
        if ($request->has('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $anggotas = $query->orderBy('nama', 'asc')->get();

        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        // Ambil data untuk pilihan orang tua
        $ayahs = Anggota::where('jenis_kelamin', 'L')->get();
        $ibus = Anggota::where('jenis_kelamin', 'P')->get();

        return view('anggota.create', compact('ayahs', 'ibus'));
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'ayah_id' => 'nullable|exists:anggotas,id',
            'ibu_id' => 'nullable|exists:anggotas,id',
            'foto' => 'nullable|image|max:2048',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        ]);
        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Simpan foto ke folder 'uploads' di dalam disk 'public'
            // Laravel akan otomatis membuatkan nama unik untuk file
            $path = $request->file('foto')->store('uploads', 'public');
            $data['foto'] = $path; // Simpan path-nya ke array data
        }


        // Simpan data ke database
        Anggota::create($data);

        // Redirect ke halaman daftar anggota dengan pesan sukses
        return redirect('/anggota')->with('success', 'Anggota keluarga berhasil ditambahkan!');
    }
    public function show($id)
    {
        $anggota = Anggota::with(['ayah', 'ibu', 'anak'])->findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    public function pohon()
    {
        // Mengambil anggota keluarga tertua (yang tidak punya ayah & ibu di sistem)
        $leluhur = Anggota::whereNull('ayah_id')->whereNull('ibu_id')->get();

        return view('anggota.pohon', compact('leluhur'));
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $ayahs = Anggota::where('jenis_kelamin', 'L')->where('id', '!=', $id)->get();
        $ibus = Anggota::where('jenis_kelamin', 'P')->where('id', '!=', $id)->get();

        return view('anggota.edit', compact('anggota', 'ayahs', 'ibus'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        $anggota->update($data);
        return redirect('/anggota')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Karena kita sudah buat fungsi 'booted' di Model, 
        // foto fisik akan otomatis terhapus saat kita panggil delete() di sini.
        $anggota->delete();

        return redirect('/anggota')->with('success', 'Anggota berhasil dihapus!');
    }
}
