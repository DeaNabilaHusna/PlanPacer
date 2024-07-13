<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Modul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        // Menggunakan $slug_proyek yang didapat dari URL
        $proyek = Project::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->get();

        if (!$proyek) {
            abort(404); // Handle jika proyek tidak ditemukan
        }
        // dd($proyek);
        // Ambil kartu tugas yang terkait dengan proyek
        $tugas = Modul::whereIn('project_id', $proyek->pluck('id'))->get();
        $tugas->load('tasks');


        return view('dashboard.modul.proyektugas', [
            'tugas' => $tugas,
            'proyek' => $proyek,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $slug)
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
                // $this->authorize('create', $proyek);

        // Simpan slug proyek ke session
        session(['slug' => $slug]);

        return view('dashboard.modul.create', [
            'proyek' => $proyek,
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
        ]);
        
        // Ambil proyek berdasarkan slug
        $proyek = Project::where('slug', $slug)
        ->where(function ($query) {
            $query->where('user_id', Auth::id())
            ->orWhereHas('users', function ($query) {
                $query->where('users.id', Auth::id());
            });
        })->first();

        if (!$proyek) {
            return redirect()->back()->withErrors(['slug' => 'Proyek tidak ditemukan.']);
        }
        // $this->authorize('create', $proyek);
        $kartuSlug = Str::slug($validatedData['modul_name']) . '-' . $proyek->slug;

        // Simpan data kartu tugas baru ke database
        $validatedData['project_id'] = $proyek->id;
        $validatedData['slug'] = $kartuSlug;
        $tugas = Modul::create($validatedData);

        return redirect('/main-menu/proyek/' . $slug . '/modul')->with('success', 'Berhasil Membuat Modul Baru');
        // return redirect()->back()->with('success', 'Kartu Tugas berhasil dibuat. ID Tugas: ' . $tugas->id);
    } catch (\Exception $e) {
        Session::flash('error', $e->getMessage());
        return back()->withInput();
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug, $id)
    {
        $proyek = Project::where('slug', $slug)->firstOrFail();
        $kartuTugas = Modul::where('id', $id)->where('project_id', $proyek->id)->firstOrFail();
        
        // $this->authorize('update', $proyek);
        return view('dashboard.modul.edit', [
            'proyek' => $proyek,
            'kartuTugas' => $kartuTugas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $slug, $id)
    {
        $validatedData = $request->validate([
            'modul_name' => 'required|max:255',
        ]);
        
        $proyek = Project::where('slug', $slug)->firstOrFail();
        $kartuTugas = Modul::where('id', $id)->where('project_id', $proyek->id)->firstOrFail();
        // $this->authorize('update', $proyek);

        $kartuTugas->modul_name = $validatedData['modul_name'];
        $kartuTugas->save();

        return redirect('/main-menu/proyek/' . $proyek->slug . '/modul')->with('success', 'Modul berhasil diperbarui.');
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
