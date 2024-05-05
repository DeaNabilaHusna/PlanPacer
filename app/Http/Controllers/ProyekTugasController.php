<?php

namespace App\Http\Controllers;

use App\Models\KartuTugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProyekTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyektugas');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat kartu tugas baru
        return view('tambahproyektugas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_tugas' => 'required|max:255',
            'tgl_mulai_proyek' => 'required',
            'tgl_selesai_proyek' => 'required',
            'status_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
        ]);

        // Simpan data kartu tugas baru ke database
        // ProyekTugas::create($validatedData);
        $validatedData['user_id'] = auth()->user()->id;

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('proyektugas')->with('success', 'Kartu Tugas berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // // Temukan kartu tugas dengan ID yang diberikan
        // $proyektugas = ProyekTugas::findOrFail($id);

        // Tampilkan halaman detail kartu tugas
        // return view('tugas.show', ['kartuTugas' => $proyektugas]);
        return view('editproyektugas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan kartu tugas dengan ID yang diberikan
        // $kartuTugas = ProyekTugas::findOrFail($id);

        // Tampilkan form untuk mengedit kartu tugas
        // return view('tugas.edit', ['kartuTugas' => $kartuTugas]);
        return view('editproyektugas');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_tugas' => 'required|max:255',
            'tgl_mulai_proyek' => 'required',
            'tgl_selesai_proyek' => 'required',
            'status_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
        ]);

        // Temukan dan perbaharui kartu tugas dengan ID yang diberikan
        KartuTugas::findOrFail($id)->update($validatedData);
        // $validatedData['user_id'] = auth()->user()->id;

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('proyektugas')->with('success', 'Kartu Tugas berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        // Temukan dan hapus kartu tugas dengan ID yang diberikan
        KartuTugas::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('proyektugas')->with('success', 'Kartu Tugas berhasil dihapus.');
    }
}
