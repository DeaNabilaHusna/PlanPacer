<?php

namespace App\Http\Controllers;

use App\Models\TugasItem;
use App\Models\Proyek;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KartuTugas;

class TugasItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        // Ambil KartuTugas berdasarkan slug
        $kartuTugas = KartuTugas::where('slug', $slug)->first();

        if (!$kartuTugas) {
            abort(404, 'Kartu Tugas tidak ditemukan');
        }

        // Ambil semua Tugas Item yang terkait dengan Kartu Tugas ini
        $tugasItems = $kartuTugas->tugasItems;

        return view('tugas.show', [
            'kartuTugas' => $kartuTugas,
            'tugasItems' => $tugasItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($proyekslug, $modulslug)
    {
        $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = KartuTugas::where('slug', $modulslug)->first();
        return view('dashboard.tugas.create', [
            'kartuTugas' => $kartuTugas,
            'proyek' => $proyek,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $proyekslug, $modulslug)
    {
        $validatedData = $request->validate([
            'nama_tugas_item' => 'required|max:255',
            'deskripsi_tugas_item' => 'nullable',
            'status_tugas_item' => 'required',
            'tgl_mulai_tugas' => 'required|date',
            'tgl_selesai_tugas' => 'required|date',
        ]);
        $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = KartuTugas::where('slug', $modulslug)->firstOrFail();

        // Buat slug untuk tugas_item
        $slug = Str::slug($validatedData['nama_tugas_item']) . '-' . Str::random(5);
        $tugasItem = new TugasItem();
        $tugasItem->kartu_id = $kartuTugas->id;
        $tugasItem->nama_tugas_item = $validatedData['nama_tugas_item'];
        $tugasItem->deskripsi_tugas_item = $validatedData['deskripsi_tugas_item'];
        $tugasItem->status_tugas_item = $validatedData['status_tugas_item'];
        $tugasItem->tgl_mulai_tugas = $validatedData['tgl_mulai_tugas'];
        $tugasItem->tgl_selesai_tugas = $validatedData['tgl_selesai_tugas'];
        $tugasItem->slug = $slug;

        // Simpan data ke dalam database
        $tugasItem->save();
        return redirect("/main-menu/proyek/{$proyek->slug}/modul")
            ->with('success', 'Tugas berhasil ditambahkan ke Modul.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TugasItem $tugasItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TugasItem $tugasItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TugasItem $tugasItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TugasItem $tugasItem)
    {
        //
    }
}
