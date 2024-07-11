<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:buat proyek', ['only' => ['create', 'store']]);
        $this->middleware('checkRoleCollaborators:lihat proyek', ['only' => ['show']]);
        $this->middleware('checkRoleCollaborators:edit proyek', ['only' => ['edit', 'update']]);
        $this->middleware('checkRoleCollaborators:hapus proyek', ['only' => ['destroy']]);
        // $this->middleware('permission:lihat proyek', ['only' => ['show']]);
        // $this->middleware('permission:edit proyek', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete proyek', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyeks = Project::latest()->filter(request(['search']))->where('user_id', Auth::id())
            ->orWhereHas('users', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->get();
        foreach ($proyeks as $proyek) {
            $jumlahKontributor = $proyek->users->count();
            $proyek->jumlahKontributor = $jumlahKontributor;
        }
        // dd ($proyek->users);
        return view('dashboard.proyek.proyek', compact('proyeks'));
    }

    // public function index()
    // {
    //     $proyeks = Project::where('user_id', Auth::id())
    //         ->orWhereJsonContains('kolaborator', Auth::id()) // Filter by collaborators including the current user
    //         ->get();

    //     foreach ($proyeks as $proyek) {
    //         // Mengambil kolaborator dalam bentuk array
    //         $kolaboratorArray = DB::table('projects')
    //             ->select('kolaborator')
    //             ->where('id', $proyek->id)
    //             ->pluck('kolaborator')
    //             ->toArray();

    //         // Menghitung jumlah kolaborator
    //         $jumlahKontributor = count(json_decode($kolaboratorArray[0], true));
    //         $proyek->jumlahKontributor = $jumlahKontributor;
    //     }

    //     return view('dashboard.proyek.proyek', compact('proyeks'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::all();
        $roles = Role::all();
        return view('dashboard.proyek.createproyek', compact('users', 'roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'project_name' => 'required|max:255',
                'project_manager' => 'max:255',
                'project_url' => 'nullable|max:255',
                'project_location' => 'nullable|max:255',
                'contact_person' => 'nullable|max:255',
                'project_description' => 'nullable',
                'project_start_date' => 'required|date',
                'project_end_date' => 'required|date|after:project_start_date',
                'visibility' => 'required',
                'project_status' => 'required',
                'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
                'kolaborator.*.id' => 'nullable|exists:users,id',
                'kolaborator.*.role_id' => 'nullable|exists:roles,id',
            ]);

            // Buat proyek dengan data yang divalidasi
            $projectData = [
                'project_name' => $validatedData['project_name'],
                'project_url' => $validatedData['project_url'],
                'project_location' => $validatedData['project_location'],
                'contact_person' => $validatedData['contact_person'],
                'project_description' => $validatedData['project_description'],
                'project_start_date' => $validatedData['project_start_date'],
                'project_end_date' => $validatedData['project_end_date'],
                'visibility' => $validatedData['visibility'],
                'project_status' => $validatedData['project_status'],
                'user_id' => auth()->user()->id,
                'project_manager' => auth()->user()->username,
            ];

            $project = Project::create($projectData);

            // Simpan kolaborator ke dalam tabel pivot user_projects jika ada
            if ($request->has('kolaborator')) {
                foreach ($validatedData['kolaborator'] as $kolaborator) {
                    $project->users()->attach($kolaborator['id'], [
                        'role_id' => $kolaborator['role_id'],
                        'assigned_by_user_id' => auth()->user()->id,
                    ]);
                }
            }
            $docs = [];
            if ($files = $request->file('file_name')) {
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $filename = $project->id . '-' . $fileNameWithoutExtension . '.' . $extension;
                    // $extension = $file->getClientOriginalExtension();
                    // $name = $file->getClientOriginalName();
                    // $fileNameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);
                    // $filename = $key . '-' . $fileNameWithoutExtension . '.' . $extension;
                    $path = $file->storeAs('uploads/docs', $filename);
                    $file->move($path, $filename);
                    $docs[] = [
                        'project_id' => $project->id,
                        'file_name' => $path,
                    ];
                }
                Document::insert($docs);
            }

            return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }


    public function show(Project $proyek, $slug, UserProject $userProyek)
    {
        // dd($proyek->users);
        $proyek = Project::where('slug', $slug)->firstOrFail();
        $kolaborator = $proyek->users()->withPivot('role_id')->get();
        // dd($kolaborator);
        $docs = $proyek->documents;
        return view('dashboard.proyek.detailproyek', [
            'proyek' => $proyek,
            'docs' => $docs,
            'kolaborator' => $kolaborator
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $proyek, $slug)
    {
        $proyek = Project::where('slug', $slug)->firstOrFail();
        $users = User::all();
        $roles = Role::all();
        $collaborators = $proyek->users()->withPivot('role_id')->get();
        $files = $proyek->documents;

        return view('dashboard.proyek.updateproyek', compact('proyek', 'users', 'roles', 'collaborators', 'files'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Project $project, $slug)
    {
        try {
            $validatedData = $request->validate([
                'project_name' => 'required|max:255',
                'project_manager' => 'max:255',
                'project_url' => 'nullable|max:255',
                'project_location' => 'nullable|max:255',
                'contact_person' => 'nullable|max:255',
                'project_description' => 'nullable',
                'project_start_date' => 'required|date',
                'project_end_date' => 'required|date|after:project_start_date',
                'visibility' => 'required',
                'project_status' => 'required',
                'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
                'kolaborator.*.id' => 'nullable|exists:users,id',
                'kolaborator.*.role_id' => 'nullable|exists:roles,id',
            ]);
            $project = Project::where('slug', $slug)->firstOrFail();

            // $validatedData['user_id'] = auth()->id();
            // $validatedData['project_manager'] = auth()->user()->username;

            $project->fill($validatedData)->save();

            // Update atau tambahkan kolaborator
            if ($request->has('kolaborator') && is_array($request->kolaborator)) {
                $kolaborators = [];
                foreach ($request->kolaborator as $kolaborator) {
                    if (isset($kolaborator['id'])) {
                        $kolaborators[$kolaborator['id']] = [
                            'role_id' => $kolaborator['role_id'],
                            'assigned_by_user_id' => auth()->id(),
                        ];
                    }
                }
                $project->users()->sync($kolaborators);
            }

            // Menghapus kolaborator yang dihapus
            if ($request->has('removed_kolaborators')) {
                $project->users()->detach($request->removed_kolaborators);
            }

            // Menghapus file-file yang dihapus dari form
            if ($request->has('removed_files')) {
                foreach ($request->removed_files as $file) {
                    $filePath = storage_path('uploads/docs/' . $file);

                    // Hapus file dari storage
                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }
                    // Hapus entri file dari database Document
                    Document::where('file_name', $file)->where('project_id', $project->id)->delete();
                }
            }

            // Menyimpan file-file baru yang diunggah
            if ($files = $request->file('file_name')) {
                // $projectId = $request->input('project_id');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $filename = $project->id . '-' . $fileNameWithoutExtension . '.' . $extension;
                    $path = $file->storeAs('uploads/docs', $filename);
                    $file->move($path, $filename);

                    Document::create([
                        'project_id' => $project->id,
                        'file_name' => $path,
                    ]);
                }
            }

            return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $proyek, $slug)
    {
        // $this->authorize('destroy', $proyek);
        $proyek = Project::where('slug', $slug)->firstOrFail();
        Project::destroy($proyek->id);
        return redirect('/main-menu/proyek')->with('success', 'Berhasil Menghapus Proyek');
    }
}
