<?php

namespace App\Http\Controllers;

use App\Models\TugasItem;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
