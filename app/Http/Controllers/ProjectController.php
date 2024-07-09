<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;
use App\Models\Document;
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
        $proyeks = Project::where('user_id', Auth::id())
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

    // public function store(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'project_name' => 'required|max:255',
    //             'project_manager' => 'max:255',
    //             'project_url' => 'nullable|max:255',
    //             'project_location' => 'nullable|max:255',
    //             'contact_person' => 'nullable|max:255',
    //             'project_description' => 'nullable',
    //             'project_start_date' => 'required|date',
    //             'project_end_date' => 'required|date|after:tgl_mulai_proyek',
    //             'visibility' => 'required',
    //             'project_status' => 'required',
    //             'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
    //             'kolaborator.*' => 'nullable|exists:users,id',
    //         ]);

    //         $validatedData['user_id'] = auth()->user()->id;
    //         $validatedData['project_manager'] = auth()->user()->username;
    //         $validatedData['kolaborator'] = json_encode($request->input('kolaborator', []));

    //         $proyek = Project::create($validatedData);

    //         if ($request->has('kolaborator')) {
    //             $proyek->users()->attach($request->input('kolaborator'));
    //         }

    //         // file 
    //         $docs = [];
    //         if ($files = $request->file('file_name')) {
    //             foreach ($files as $key => $file) {
    //                 $extension = $file->getClientOriginalExtension();
    //                 $filename = $key . '-' . time() . '.' . $extension;
    //                 $path = $file->storeAs('uploads/docs', $filename);
    //                 $file->move($path, $filename);
    //                 $docs[] = [
    //                     'project_id' => $proyek->id,
    //                     'file_name' => $path . $file,
    //                 ];
    //             }
    //         }
    //         Document::insert($docs);

    //         return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
    //     } catch (\Exception $e) {
    //         Session::flash('error', $e->getMessage());
    //         return back()->withInput();
    //     }
    // }
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
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $key . '-' . time() . '.' . $extension;
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
//     public function show(Project $proyek, $slug, UserProject $userProyek)
// {
//     $proyek = Project::where('slug', $slug)
//                     ->with(['users.roles']) // Eager loading pengguna dan peran
//                     ->firstOrFail();
//     $docs = $proyek->documents;

//     return view('dashboard.proyek.detailproyek', [
//         'proyek' => $proyek,
//         'docs' => $docs
//     ]);
// }
    


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Project $proyek, $slug)
    // {
    //     // dd($proyek);
    //     // $this->authorize('update', $proyek);
    //     // $proyek = Project::where('slug', $slug)->firstOrFail();
    //     $users = User::all();
    //     return view('dashboard.proyek.updateproyek', [
    //         'proyek' => $proyek,
    //         'users' => $users,
    //     ]);
    // }

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
        public function update(Request $request, Project $proyek, $slug)
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
                'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048'
            ]);

            // Update proyek dengan data yang divalidasi
            $proyek->fill($validatedData)->save();

            // Menghapus file-file yang dihapus dari form
            if ($request->has('removed_files')) {
                foreach ($request->removed_files as $file) {
                    // Hapus file dari storage
                    Storage::delete($file);
                    // Hapus entri dari tabel dokumen
                    Document::where('file_name', $file)->delete();
                }
            }

            // Menyimpan file-file baru yang diunggah
            if ($files = $request->file('file_name')) {
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $key . '-' . time() . '.' . $extension;
                    $path = $file->storeAs('uploads/docs', $filename);

                    // Pindahkan file dari temporary storage ke storage yang ditentukan
                    $file->move(storage_path('app/' . $path), $filename);

                    // Simpan entri dokumen baru
                    Document::create([
                        'project_id' => $proyek->id,
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



    // public function update(Request $request, Project $proyek, $slug)
    // {
    //     try {
    //         // $this->authorize('update', $proyek);
    //         $proyek = Project::where('slug', $slug)->firstOrFail();
    //         $validatedData = $request->validate([
    //             'project_name' => 'required|max:255',
    //             'project_url' => 'nullable|max:255',
    //             'project_location' => 'nullable|max:255',
    //             'contact_person' => 'nullable|max:255',
    //             'project_description' => 'nullable',
    //             'project_start_date' => 'required',
    //             'project_end_date' => 'required',
    //             'visibility' => 'required',
    //             'project_status' => 'required',
    //             'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
    //         ]);

    //         // Handle file updates
    //         if ($request->hasFile('file_name')) {
    //             // Delete old files
    //             if ($proyek->files) {
    //                 foreach ($proyek->files as $file) {
    //                     Storage::delete($file->file_name);
    //                     Document::where('file_name', $file)->delete();
    //                 }
    //             }

    //             // Upload new files
    //             $docs = [];
    //             foreach ($request->file('file_name') as $key => $file) {
    //                 $extension = $file->getClientOriginalExtension();
    //                 $filename = $key . '-' . time() . '.' . $extension;
    //                 $path = $file->storeAs('uploads/docs', $filename);
    //                 $docs[] = [
    //                     'project_id' => $proyek->id,
    //                     'file_name' => $path,
    //                 ];
    //             }
    //             // Insert new files
    //             Document::insert($docs);
    //         }

    //         // Handle collaborators based on visibility
    //         if ($request->visibilitas === 'private') {
    //             $proyek->kolaborators()->detach();
    //         } else {
    //             $validatedData['kolaborator'] = $request->kolaborator;
    //         }

    //         $proyek->update($validatedData);
    //         return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
    //     } catch (\Exception $e) {
    //         Session::flash('error', $e->getMessage());
    //         return back()->withInput();
    //     }
    // }

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
