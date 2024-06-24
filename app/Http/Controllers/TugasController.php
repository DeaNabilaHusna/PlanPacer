<?php

namespace App\Http\Controllers;

use App\Models\TugasItem;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;


class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // Ambil user yang sedang login
            $user = Auth::user();
    
            // Ambil semua tugas yang terkait dengan penanggungjawab_id user yang sedang login
            $tugasItems = TugasItem::whereHas('users', function($query) use ($user) {
                $query->where('user_tugasitems.penanggungjawab_id', $user->id);
            })->with('kartutugas')->get();
    
            // Kirim data tersebut ke view blade
            return view('dashboard.tugas.index', compact('tugasItems'));

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
