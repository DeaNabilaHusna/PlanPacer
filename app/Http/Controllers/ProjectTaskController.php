<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\UserTask;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Modul;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProjectTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:buat tugas', ['only' => ['create', 'store']]);
        $this->middleware('permission:lihat tugas', ['only' => ['show']]);
        $this->middleware('permission:edit tugas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hapus tugas', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        // Ambil KartuTugas berdasarkan slug
        $kartuTugas = Modul::where('slug', $slug)->first();

        if (!$kartuTugas) {
            abort(404, 'Kartu Tugas tidak ditemukan');
        }

        // Ambil semua Tugas Item yang terkait dengan Modul
        $tugasItems = $kartuTugas->tasks;

        return view('tugas.show', [
            'kartuTugas' => $kartuTugas,
            'tugasItems' => $tugasItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($proyekslug, $modulslug)
    // {
    //     $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
    //     $kartuTugas = KartuTugas::where('slug', $modulslug)->first();
    //     return view('dashboard.tugas.create', [
    //         'kartuTugas' => $kartuTugas,
    //         'proyek' => $proyek,
    //     ]);
    // }
    public function create($proyekslug, $modulslug)
    {
        $proyek = Project::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = Modul::where('slug', $modulslug)->firstOrFail();
        $kolaborator = UserProject::where('project_id', $proyek->id)
            ->get();

        $kolaborator = $kolaborator->map(function ($item) {
            $user = User::find($item->assignee_user_id);
            if ($user) {
                return [
                    'id' => $item->assignee_user_id,
                    'username' => $user->username,
                    'email' => $user->email
                ];
            } else {
                return null;
            }
        })->filter();

        return view('dashboard.tugas.create', [
            'kartuTugas' => $kartuTugas,
            'proyek' => $proyek,
            'kolaborator' => $kolaborator,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, $proyekslug, $modulslug)
{
    try {
        // Validasi data dari request
        $validatedData = $request->validate([
            'task_name' => [
                'required',
                'max:255',
                Rule::unique('tasks')->where(function ($query) use ($proyekslug, $modulslug) {
                    $proyek = Project::where('slug', $proyekslug)->first();
                    $kartuTugas = Modul::where('slug', $modulslug)->first();
                    return $query->where('project_id', $proyek->id)
                        ->where('modul_id', $kartuTugas->id);
                }),
            ],
            'task_description' => 'nullable',
            'task_status' => 'required',
            'task_start_date' => 'required|date',
            'task_end_date' => 'required|date',
            'project_manager_id' => 'nullable|array',
            'project_manager_id.*' => 'exists:users,id',
        ]);

        // Cari proyek berdasarkan slug
        $proyek = Project::where('slug', $proyekslug)->firstOrFail();

        // Cari kartu tugas berdasarkan slug
        $kartuTugas = Modul::where('slug', $modulslug)->firstOrFail();

        // Inisialisasi nilai default jika 'project_manager_id' kosong dan proyek adalah private
        if ($proyek->visibilitas === 'private' && empty($validatedData['project_manager_id'])) {
            $validatedData['project_manager_id'] = [auth()->user()->id];
        }

        $slug = Str::slug($validatedData['task_name']) . '-' . Str::random(5);

        $tugasItem = new Task();
        $tugasItem->project_id = $proyek->id;
        $tugasItem->modul_id = $kartuTugas->id;
        $tugasItem->task_name = $validatedData['task_name'];
        $tugasItem->task_description = $validatedData['task_description'];
        $tugasItem->task_status = $validatedData['task_status'];
        $tugasItem->task_start_date = $validatedData['task_start_date'];
        $tugasItem->task_end_date = $validatedData['task_end_date'];
        $tugasItem->slug = $slug;
        $tugasItem->save();
        // dd($tugasItem);

        // Simpan penanggung jawab 
        if (!empty($validatedData['project_manager_id'])) {
            foreach ($validatedData['project_manager_id'] as $userId) {
                $user = User::findOrFail($userId);
                UserTask::create([
                    'project_manager_id' => $userId,
                    'project_id' => $proyek->id,
                    'modul_id' => $kartuTugas->id,
                    'project_manager_email' => $user->email,
                ]);
            }
        }

        return redirect("/main-menu/proyek/{$proyek->slug}/modul")
            ->with('success', 'Tugas berhasil ditambahkan ke Modul.');

    } catch (\Exception $e) {
        // Tangani pengecualian jika terjadi kesalahan
        Session::flash('error', $e->getMessage());
        return back()->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show($proyekslug, $modulslug, $tugasslug)
{
    // Cari proyek berdasarkan slug
    $proyek = Project::where('slug', $proyekslug)->firstOrFail();

    // Cari modul berdasarkan slug
    $modul = Modul::where('slug', $modulslug)->firstOrFail();

    // Cari tugas berdasarkan slug
    $tugasItem = Task::where('slug', $tugasslug)->firstOrFail();

    // Ambil penanggung jawab dari tabel user_tasks yang berhubungan dengan project_id dan modul_id
    $penanggungjawabs = DB::table('user_tasks')
        ->join('users', 'user_tasks.project_manager_id', '=', 'users.id')
        ->where('user_tasks.project_id', $proyek->id)
        ->where('user_tasks.modul_id', $modul->id)
        ->select('users.*')
        ->get();

    // Tampilkan view dengan data yang diperlukan
    return view('dashboard.tugas.detail', compact('tugasItem', 'proyek', 'modul', 'penanggungjawabs'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $tugasItem, $proyekslug, $modulslug, $tugasslug)
    {
        // $this->authorize('update', $tugasItem);

        $proyek = Project::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = Modul::where('slug', $modulslug)->firstOrFail();
        $tugasItem = Task::where('slug', $tugasslug)->firstOrFail();
        $kolaborator = UserProject::where('project_id', $proyek->id)
            ->get();

        $kolaborator = $kolaborator->map(function ($item) {
            $user = User::find($item->assignee_user_id);
            if ($user) {
                return [
                    'id' => $item->assignee_user_id,
                    'username' => $user->username,
                    'email' => $user->email
                ];
            } else {
                return null;
            }
        })->filter();

        return view('dashboard.tugas.edit', [
            'tugasItem' => $tugasItem,
            'proyek' => $proyek,
            'kartuTugas' => $kartuTugas,
            'kolaborator' => $kolaborator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $tugasItem, $proyekslug, $modulslug, $tugasItemSlug)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'task_name' => [
                    'required',
                    'max:255',
                    Rule::unique('tasks')->ignore($tugasItemSlug, 'slug')->where(function ($query) use ($proyekslug, $modulslug) {
                        $proyek = Project::where('slug', $proyekslug)->first();
                        $kartuTugas = Modul::where('slug', $modulslug)->first();
                        return $query->where('project_id', $proyek->id)
                            ->where('modul_id', $kartuTugas->id);
                    }),
                ],
                'task_description' => 'nullable',
                'task_status' => 'required',
                'task_start_date' => 'required|date',
                'task_end_date' => 'required|date',
                'project_manager_id.*' => 'exists:users,id',
            ]);

            // Cari proyek, kartu tugas, dan tugas item berdasarkan slug
            $proyek = Project::where('slug', $proyekslug)->firstOrFail();
            $kartuTugas = Modul::where('slug', $modulslug)->firstOrFail();
            $tugasItem = Task::where('slug', $tugasItemSlug)->firstOrFail();
            if ($proyek->visibilitas === 'private' && empty($validatedData['project_manager_id'])) {
                $validatedData['project_manager_id'] = [auth()->user()->id];
            }
            $slug = Str::slug($validatedData['task_name']) . '-' . Str::random(5);

            $tugasItem->task_name = $validatedData['task_name'];
            $tugasItem->task_description = $validatedData['task_description'];
            $tugasItem->task_status = $validatedData['task_status'];
            $tugasItem->task_start_date = $validatedData['task_start_date'];
            $tugasItem->task_end_date = $validatedData['task_end_date'];
            $tugasItem->slug = $slug;
            $tugasItem->save();

            // Hapus penanggung jawab yang lama
            UserTask::where('id', $tugasItem->id)->delete();

            // Simpan penanggung jawab yang baru
            foreach ($validatedData['project_manager_id'] as $userId) {
                $user = User::findOrFail($userId);

                UserTask::create([
                    'task_id' => $tugasItem->id,
                    'project_manager_id' => $userId,
                    'project_id' => $proyek->id,
                    'modul_id' => $kartuTugas->id,
                    'project_manager_email' => $user->email,
                ]);
            }

            return redirect("/main-menu/proyek/{$proyek->slug}/modul")
                ->with('success', 'Tugas berhasil diperbarui.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $tugasItem, $proyekslug, $modulslug, $tugasItemSlug)
    {
        try {
            $tugasItem = Task::where('slug', $tugasItemSlug)->firstOrFail();
            $tugasItem->delete();

            return redirect("/main-menu/proyek/{$proyekslug}/modul")
                ->with('success', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();
        }
    }
}
