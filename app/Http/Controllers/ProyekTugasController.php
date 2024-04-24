<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuTugas; // Import model KartuTugas

class ProyekTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kartu tugas dari database
        $kartuTugas = KartuTugas::all();
        return view('tugas.index', ['kartuTugas' => $kartuTugas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat kartu tugas baru
        return view('tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'proyek_id' => 'required',
            'nama_kartu' => 'required|max:255',
        ]);

        // Simpan data kartu tugas baru ke database
        KartuTugas::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kartu-tugas.index')->with('success', 'Kartu Tugas berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Temukan kartu tugas dengan ID yang diberikan
        $kartuTugas = KartuTugas::findOrFail($id);

        // Tampilkan halaman detail kartu tugas
        return view('tugas.show', ['kartuTugas' => $kartuTugas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan kartu tugas dengan ID yang diberikan
        $kartuTugas = KartuTugas::findOrFail($id);

        // Tampilkan form untuk mengedit kartu tugas
        return view('tugas.edit', ['kartuTugas' => $kartuTugas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'proyek_id' => 'required',
            'nama_kartu' => 'required|max:255',
        ]);

        // Temukan dan perbaharui kartu tugas dengan ID yang diberikan
        KartuTugas::findOrFail($id)->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kartu-tugas.index')->with('success', 'Kartu Tugas berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    // public function destroy(string $id)
    // {
    //     // Temukan dan hapus kartu tugas dengan ID yang diberikan
    //     KartuTugas::findOrFail($id)->delete();

    //     // Redirect ke halaman index dengan pesan sukses
    //     return redirect()->route('kartu-tugas.index')->with('success', 'Kartu Tugas berhasil dihapus.');
    // }
}
