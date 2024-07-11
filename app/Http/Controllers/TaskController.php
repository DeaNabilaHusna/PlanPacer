<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // return view('dashboard.tugas.index', compact('tugasItems'));
        // $user = Auth::user();

        // // Ambil semua tugas yang terkait dengan penanggung jawab yang sedang login
        // $tugasItems = $user->tasks;

        // // Kirim data tersebut ke view blade
        // return view('dashboard.tugas.index', compact('tugasItems'));
        $user = Auth::user();

    // Ambil semua tugas yang terkait dengan penanggung jawab yang sedang login
    $tugasItems = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
                    ->whereHas('user', function($query) use ($user) {
                        $query->where('project_manager_id', $user->id);
                    })
                    ->select('tasks.*', 'projects.project_name')
                    ->get();

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
    public function show(Task $tugasItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $tugasItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $tugasItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $tugasItem)
    {
        //
    }
}
