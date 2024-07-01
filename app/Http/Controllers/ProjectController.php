<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:buat proyek', ['only' => ['create', 'store']]);
        $this->middleware('permission:lihat proyek', ['only' => ['show']]);
        $this->middleware('permission:edit proyek', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete proyek', ['only' => ['destroy']]);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.proyek.createproyek', compact('users'));
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
                'project_end_date' => 'required|date|after:tgl_mulai_proyek',
                'visibility' => 'required',
                'project_status' => 'required',
                'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
                'kolaborator.*' => 'nullable|exists:users,id',
            ]);

            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['project_manager'] = auth()->user()->username;
            $validatedData['kolaborator'] = json_encode($request->input('kolaborator', []));

            $proyek = Project::create($validatedData);

            if ($request->has('kolaborator')) {
                $proyek->users()->attach($request->input('kolaborator'));
            }

            // file 
            $docs = [];
            if ($files = $request->file('file_name')) {
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $key . '-' . time() . '.' . $extension;
                    $path = $file->storeAs('uploads/docs', $filename);
                    $file->move($path, $filename);
                    $docs[] = [
                        'project_id' => $proyek->id,
                        'file_name' => $path . $file,
                    ];
                }
            }
            Document::insert($docs);

            return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function show(Project $proyek, $slug, UserProject $userProyek)
    {
        // $userProyek = UserProyek::where('assignee_user_id', Auth::id())->first();
        // dd($userProyek);

        $proyek = Project::where('slug', $slug)->firstOrFail();
        $this->authorize('view', $proyek);
        $docs = Document::where('project_id', $proyek->id)->get();
        return view('dashboard.proyek.detailproyek', [
            'proyek' => $proyek,
            'document' => $docs
        ]);
        // return $proyek;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $proyek, $slug)
    {
        $proyek = Project::where('slug', $slug)->firstOrFail();
        // $this->authorize('update', $proyek);
        $users = User::all();
        return view('dashboard.proyek.updateproyek', [
            'proyek' => $proyek,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $proyek, $slug)
    {
        $proyek = Project::where('slug', $slug)->firstOrFail();
        // $this->authorize('update', $proyek);
        $validatedData = $request->validate([
            'project_name' => 'required|max:255',
            'project_url' => 'nullable|max:255',
            'project_location' => 'nullable|max:255',
            'contact_person' => 'nullable|max:255',
            'project_description' => 'nullable',
            'project_start_date' => 'required',
            'project_end_date' => 'required',
            'visibility' => 'required',
            'project_status' => 'required',
            'file_name.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        ]);

        // Handle file updates
        if ($request->hasFile('file_name')) {
            // Delete old files
            if ($proyek->files) {
                foreach ($proyek->files as $file) {
                    Storage::delete($file->file_name);
                }
            }

            // Upload new files
            $docs = [];
            foreach ($request->file('file_name') as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;
                $path = $file->storeAs('uploads/docs', $filename);
                $docs[] = [
                    'project_id' => $proyek->id,
                    'file_name' => $path,
                ];
            }
            // Insert new files
            Document::insert($docs);
        }

        // Handle collaborators based on visibility
        if ($request->visibilitas === 'private') {
            $proyek->kolaborators()->detach();
        } else {
            $validatedData['kolaborator'] = $request->kolaborator;
        }

        $proyek->update($validatedData);
        return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $proyek, $slug)
    {
        $proyek = Project::where('slug', $slug)->firstOrFail();
        $this->authorize('delete', $proyek);
        Project::destroy($proyek->id);
        return redirect('/main-menu/proyek')->with('success', 'Berhasil Menghapus Proyek');
    }
   
}
