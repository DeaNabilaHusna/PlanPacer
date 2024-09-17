<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Modul;
use App\Models\UserProject;
use App\Models\UserModul;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use GuzzleHttp\Handler\Proxy;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProjectModulController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:buat modul', ['only' => ['create', 'store']]);
        // $this->middleware('permission:lihat modul', ['only' => ['show']]);
        // $this->middleware('permission:edit modul', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:hapus modul', ['only' => ['destroy']]);
        $this->middleware('checkRoleCollaborators:buat modul', ['only' => ['create', 'store']]);
        $this->middleware('checkRoleCollaborators:lihat modul', ['only' => ['show']]);
        $this->middleware('checkRoleCollaborators:edit modul', ['only' => ['edit', 'update']]);
        $this->middleware('checkRoleCollaborators:hapus modul', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug)
    {
        // Mendapatkan proyek berdasarkan slug
        $proyek = Project::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first(); // Use first() to get a single project

        if (!$proyek) {
            abort(404); // Handle jika proyek tidak ditemukan
        }


        // Mendapatkan project_id dari proyek yang ditemukan
        $projectId = $proyek->id;

        // Ambil kartu tugas yang terkait dengan proyek
        $tugas = Modul::where('project_id', $projectId)->get();

        // Buat array untuk menyimpan handledByIds untuk setiap modul
        $handledByIdsArray = [];

        foreach ($tugas as $tugasItem) {
            // Mendapatkan handled_by_id untuk setiap modul
            $handledByIds = UserModul::where('modul_id', $tugasItem->id)->pluck('handled_by_id')->toArray();
            $handledByIdsArray[$tugasItem->id] = $handledByIds;
        }
        $users = User::all();
        return view('dashboard.modul.index', [
            'tugas' => $tugas,
            'proyek' => $proyek,
            'handledByIdsArray' => $handledByIdsArray,
            'users' => $users
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $slug)
    {
        // Retrieve the project based on the slug
        $proyek = Project::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first();

        if (!$proyek) {
            abort(404); // Handle if project not found
        }

        // Retrieve collaborators
        $kolaborator = UserProject::where('project_id', $proyek->id)
            ->get()
            ->map(function ($item) {
                $user = User::find($item->assignee_user_id);
                if ($user) {
                    return [
                        'id' => $item->assignee_user_id,
                        'username' => $user->username,
                        'email' => $user->email
                    ];
                }
                return null;
            })->filter();

        session(['slug' => $slug]);

        return view('dashboard.modul.create', [
            'proyek' => $proyek,
            'kolaborator' => $kolaborator,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        try {
            $validatedData = $request->validate([
                'modul_name' => [
                    'required',
                    'max:255',
                    Rule::unique('moduls')->where(function ($query) use ($slug) {
                        return $query->where('project_id', Project::where('slug', $slug)->first()->id);
                    }),
                ],
                'modul_description' => 'nullable',
                'modul_status' => 'required',
                'modul_start_date' => 'required|date',
                'modul_end_date' => 'required|date',
                'handled_by_id' => 'nullable|array',
                'handled_by_id.*' => 'exists:users,id',
            ]);

            $proyek = Project::where('slug', $slug)->firstOrFail();

            if (!$proyek) {
                return redirect()->back()->withErrors(['slug' => 'Proyek tidak ditemukan.']);
            }
            if ($proyek->visibility === 'private' && empty($validatedData['handled_by_id'])) {
                $validatedData['handled_by_id'] = [auth()->user()->id];
            }
            $kartuSlug = Str::slug($validatedData['modul_name']) . '-' . $proyek->slug;

            // Simpan data kartu tugas baru ke database
            $validatedData['project_id'] = $proyek->id;
            $validatedData['slug'] = $kartuSlug;
            $modul = Modul::create($validatedData);
            foreach ($validatedData['handled_by_id'] as $userId) {
                UserModul::create([
                    'handled_by_id' => $userId,
                    'project_id' => $proyek->id,
                    'modul_id' => $modul->id,
                    'handled_by_email' => User::find($userId)->email,
                ]);
            }

            $proyek->updateStatus();
            return redirect('/main-menu/proyek/' . $slug . '/modul')->with('success', 'Berhasil Membuat Modul Baru');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($proyekslug, $modulslug)
    {
         // Cari proyek berdasarkan slug
    $proyek = Project::where('slug', $proyekslug)->firstOrFail();

    // Cari modul berdasarkan slug
    $modul = Modul::where('slug', $modulslug)->firstOrFail();

    // Ambil penanggung jawab dari tabel user_tasks yang berhubungan dengan project_id dan modul_id
    $kolaborator = DB::table('user_moduls')
        ->join('users', 'user_moduls.handled_by_id', '=', 'users.id')
        ->where('user_moduls.project_id', $proyek->id)
        ->where('user_moduls.modul_id', $modul->id)
        ->select('users.*')
        ->get();

    return view('dashboard.modul.detail', compact('proyek', 'modul', 'kolaborator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($projectSlug, $modulSlug)
    {
        // Cari proyek berdasarkan slug
        $proyek = Project::where('slug', $projectSlug)->firstOrFail();

        // Cari modul berdasarkan slug
        $kartuTugas = Modul::where('slug', $modulSlug)
            ->where('project_id', $proyek->id)
            ->firstOrFail();
        $kolaborator = $proyek->users()->get();

        // Ambil handled_by_id yang sudah disimpan untuk modul ini
        $handledByIds = UserModul::where('modul_id', $kartuTugas->id)
            ->pluck('handled_by_id')
            ->toArray();

        return view('dashboard.modul.edit', [
            'kartuTugas' => $kartuTugas,
            'proyek' => $proyek,
            'kolaborator' => $kolaborator,
            'handledByIds' => $handledByIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug, $modulId)
    {
        try {
            $modul = Modul::findOrFail($modulId);
    
            // Validate the request data
            $validatedData = $request->validate([
                'modul_name' => [
                    'required',
                    'max:255',
                    Rule::unique('moduls')->where(function ($query) use ($slug, $modul) {
                        return $query->where('project_id', Project::where('slug', $slug)->first()->id)
                            ->where('id', '!=', $modul->id);
                    }),
                ],
                'modul_description' => 'nullable',
                'modul_status' => 'required',
                'modul_start_date' => 'required|date',
                'modul_end_date' => 'required|date',
                'handled_by_id' => 'nullable|array',
                'handled_by_id.*' => 'exists:users,id',
            ]);
    
            $proyek = Project::where('slug', $slug)->firstOrFail();
    
            // Default handled_by_id if project is private
            if ($proyek->visibility === 'private' && empty($validatedData['handled_by_id'])) {
                $validatedData['handled_by_id'] = [auth()->user()->id];
            }
    
            // Generate a new slug if the modul_name has changed
            if ($modul->modul_name !== $validatedData['modul_name']) {
                $validatedData['slug'] = Str::slug($validatedData['modul_name']) . '-' . $proyek->slug;
            }
    
            // Update the modul record
            $modul->update($validatedData);
    
            // Sync users and ensure valid IDs
            $userIds = array_filter($validatedData['handled_by_id']);
            $modul->users()->sync(array_map(function ($userId) use ($proyek) {
                $user = User::findOrFail($userId);
                return [
                    'handled_by_email' => $user->email,
                    'project_id' => $proyek->id,
                    'updated_at' => now(),
                    'handled_by_id' => $userId, // Ensure this is set correctly
                ];
            }, $userIds));
            $proyek->updateStatus();
            return redirect('/main-menu/proyek/' . $slug . '/modul')->with('success', 'Berhasil Memperbarui Modul');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, $slug, $kartuslug)
    {
        // Ambil proyek berdasarkan slug
        $proyek = Project::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first();

        if (!$proyek) {
            abort(404); // Handle jika proyek tidak ditemukan
        }
        // $this->authorize('destroy', $proyek);

        // Temukan kartu tugas dengan ID yang diberikan
        $kartuTugas = Modul::where('slug', $kartuslug)->where('project_id', $proyek->id)->first();

        if (!$kartuTugas) {
            abort(404); // Handle jika kartu tugas tidak ditemukan
        }

        $kartuTugas->delete();

        return redirect()->back()->with('success', 'Modul berhasil dihapus.');
    }
}
