<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Project;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $moduls = Modul::join('projects', 'moduls.project_id', '=', 'projects.id')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('handled_by_id', $user->id);
            })
            ->select('moduls.*', 'projects.project_name')
            ->paginate(7);

        // Kirim data tersebut ke view blade
        return view('dashboard.tugas.index', compact('moduls'));
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
    public function show(Modul $modul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        //
    }
}
