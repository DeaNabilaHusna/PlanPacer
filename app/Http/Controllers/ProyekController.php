<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\FilePendukung;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyeks = Proyek::where('user_id', Auth::id())
            ->orWhereHas('users', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->get();
            foreach ($proyeks as $proyek) {
                $jumlahKontributor = $proyek->users->count(); // Mengurangi satu untuk menghapus pemilik proyek
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
                'nama_proyek' => 'required|max:255',
                'penanggungjawab_proyek' => 'max:255',
                'url_proyek' => 'nullable|max:255',
                'deskripsi_proyek' => 'nullable',
                'tgl_mulai_proyek' => 'required|date',
                'tgl_selesai_proyek' => 'required|date|after:tgl_mulai_proyek',
                'visibilitas' => 'required',
                'status_proyek' => 'required',
                'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
                'kolaborator.*' => 'nullable|exists:users,id',
            ]);

            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['penanggungjawab_proyek'] = auth()->user()->username;
            $validatedData['kolaborator'] = json_encode($request->input('kolaborator', []));

            $proyek = Proyek::create($validatedData);

            if ($request->has('kolaborator')) {
                $proyek->users()->attach($request->input('kolaborator'));
            }

            // file 
            $docs = [];
            if ($files = $request->file('nama_file')) {
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $key . '-' . time() . '.' . $extension;
                    $path = $file->storeAs('uploads/docs', $filename);
                    $file->move($path, $filename);
                    $docs[] = [
                        'proyek_id' => $proyek->id,
                        'nama_file' => $path . $file,
                    ];
                }
            }
            FilePendukung::insert($docs);

            return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        return back()->withInput();
        }
    }
    // public function store(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'nama_proyek' => 'required|max:255',
    //             'penanggungjawab_proyek' => 'max:255',
    //             'url_proyek' => 'nullable|max:255',
    //             'deskripsi_proyek' => 'nullable',
    //             'tgl_mulai_proyek' => 'required|date',
    //             'tgl_selesai_proyek' => 'required|date|after:tgl_mulai_proyek',
    //             'visibilitas' => 'required',
    //             'status_proyek' => 'required',
    //             'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
    //             'kolaborator.*' => 'nullable|exists:users,id',
    //         ]);

    //         $validatedData['user_id'] = auth()->user()->id;
    //         $validatedData['penanggungjawab_proyek'] = auth()->user()->username;
    //         $validatedData['kolaborator'] = json_encode($request->input('kolaborator', []));

    //         $proyek = Proyek::create($validatedData);

    //         if ($request->has('kolaborator')) {
    //             $proyek->users()->attach($request->input('kolaborator'));
    //         }

    //         // file 
    //         $docs = [];
    //         if ($files = $request->file('nama_file')) {
    //             foreach ($files as $key => $file) {
    //                 $extension = $file->getClientOriginalExtension();
    //                 $filename = $key . '-' . time() . '.' . $extension;
    //                 $path = $file->storeAs('uploads/docs', $filename);
    //                 $file->move($path, $filename);
    //                 $docs[] = [
    //                     'proyek_id' => $proyek->id,
    //                     'nama_file' => $path . $file,
    //                 ];
    //             }
    //         }
    //         FilePendukung::insert($docs);
    //         $rolePic = Role::where('name', 'pic')->first();
    //         if ($rolePic) {
    //             UserProyek::create([
    //                 'user_id' => auth()->user()->id,
    //                 'proyek_id' => $proyek->id,
    //                 'role_id' => $rolePic->id,
    //             ]);
    //         }

    //         return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
    //     } catch (\Exception $e) {
    //         Session::flash('error', $e->getMessage());
    //         return back()->withInput();
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // ddd ($request->all());
    //     try {
    //         $validatedData = $request->validate([
    //             'nama_proyek' => 'required|max:255',
    //             'penanggungjawab_proyek' => 'max:255',
    //             'url_proyek' => 'nullable|max:255',
    //             'deskripsi_proyek' => 'nullable',
    //             'tgl_mulai_proyek' => 'required|date',
    //             'tgl_selesai_proyek' => 'required|date|after:tgl_mulai_proyek',
    //             'visibilitas' => 'required',
    //             'status_proyek' => 'required',
    //             'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
    //             'kolaborator.*' => 'nullable|exists:users,id',
    //         ]);

    //         $validatedData['user_id'] = auth()->user()->id;
    //         $validatedData['penanggungjawab_proyek'] = auth()->user()->username;
    //         $validatedData['kolaborator'] = json_encode($request->input('kolaborator', []));


    //         $proyek = Proyek::create($validatedData);
    //         // kolabolator
    //         $kolaborator = $request->input('kolaborator', []);
    //         $proyek->users()->sync($request->input('kolaborator', []));

    //         // file
    //         $docs = [];
    //         if ($files = $request->file('nama_file')) {
    //             foreach ($files as $key => $file) {
    //                 $extension = $file->getClientOriginalExtension();
    //                 $filename = $key . '-' . time() . '.' . $extension;
    //                 $path = $file->storeAs('uploads/docs', $filename);
    //                 $file->move($path, $filename);
    //                 $docs[] = [
    //                     'proyek_id' => $proyek->id,
    //                     'nama_file' => $path . $file,
    //                 ];
    //             }
    //         }
    //         FilePendukung::insert($docs);

    //         return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
    //     } catch (\Exception $e) {
    //         return back()->withError($e->getMessage())->withInput();
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        $docs = FilePendukung::where('proyek_id', $proyek->id)->get();
        return view('dashboard.proyek.detailproyek', [
            'proyek' => $proyek,
            'file_pendukung' => $docs
        ]);
        // return $proyek;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyek $proyek)
    {
        $users = User::all();
        return view('dashboard.proyek.updateproyek', [
            'proyek' => $proyek,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        $validatedData = $request->validate([
            'nama_proyek' => 'required|max:255',
            'url_proyek' => 'nullable|max:255',
            'deskripsi_proyek' => 'nullable',
            'tgl_mulai_proyek' => 'required',
            'tgl_selesai_proyek' => 'required',
            'visibilitas' => 'required',
            'status_proyek' => 'required',
            'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        ]);

        // Handle file updates
        if ($request->hasFile('nama_file')) {
            // Delete old files
            if ($proyek->files) {
                foreach ($proyek->files as $file) {
                    Storage::delete($file->nama_file);
                }
            }

            // Upload new files
            $docs = [];
            foreach ($request->file('nama_file') as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;
                $path = $file->storeAs('uploads/docs', $filename);
                $docs[] = [
                    'proyek_id' => $proyek->id,
                    'nama_file' => $path,
                ];
            }
            // Insert new files
            FilePendukung::insert($docs);
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

    // public function update(Request $request, Proyek $proyek)
    // {
    //     $validatedData = $request->validate([
    //         'nama_proyek' => 'required|max:255',
    //         'url_proyek' => 'nullable|max:255',
    //         'deskripsi_proyek' => 'nullable',
    //         'tgl_mulai_proyek' => 'required',
    //         'tgl_selesai_proyek' => 'required',
    //         'visibilitas' => 'required',
    //         'status_proyek' => 'required',
    //         'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
    //         'kolaborator.*' => 'nullable|exists:users,id',

    //     ]);

    //     // Handle file updates
    //     if ($request->hasFile('nama_file')) {
    //         // Delete file lama
    //         if ($proyek->files) {
    //             foreach ($proyek->files as $file) {
    //                 Storage::delete($file->nama_file);
    //             }
    //         }

    //         // Upload file baru
    //         $docs = [];
    //         foreach ($request->file('nama_file') as $key => $file) {
    //             $extension = $file->getClientOriginalExtension();
    //             $filename = $key . '-' . time() . '.' . $extension;
    //             $path = $file->storeAs('uploads/docs', $filename);
    //             $docs[] = [
    //                 'proyek_id' => $proyek->id,
    //                 'nama_file' => $path,
    //             ];
    //         }
    //         // Insert file baru
    //         FilePendukung::insert($docs);
    //     }

    //     $proyek->update($validatedData);
    //     return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
    // }

    //     public function update(Request $request, Proyek $proyek)
    //     {
    //         $validatedData = $request->validate([
    //             'nama_proyek' => 'required|max:255',
    //             'url_proyek' => 'nullable|max:255',
    //             'deskripsi_proyek' => 'nullable',
    //             'tgl_mulai_proyek' => 'required',
    //             'tgl_selesai_proyek' => 'required',
    //             'visibilitas' => 'required',
    //             'status_proyek' => 'required',
    //             'nama_file.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',

    //         ]);
    //         $validatedData['user_id'] = auth()->user()->id;
    //         Proyek::where('id', $proyek->id)->update($validatedData);
    //         return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
    // ;

    //     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        Proyek::destroy($proyek->id);
        return redirect('/main-menu/proyek')->with('success', 'Berhasil Menghapus Proyek');
    }
}
