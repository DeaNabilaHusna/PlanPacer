<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\FilePendukung;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.proyek.proyek',[
            'proyeks' => Proyek::where ('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('dashboard.proyek.createproyek');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // ddd ($request);
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
        $validatedData['user_id'] = auth()->user()->id;
        $proyek = Proyek::create($validatedData);
        $docs = [];
        if($files = $request->file('nama_file')){
            foreach($files as $key => $file){
                $extension = $file->getClientOriginalExtension();
                $filename = $key.'-'.time().'.'.$extension;
                $path = $file->storeAs('uploads/docs', $filename); 
                $file->move($path, $filename); 
                $docs[] = [
                    'proyek_id' => $proyek->id,
                    'nama_file' => $path.$file,
                ];
            }
        }
        FilePendukung::insert($docs);
        return redirect('/main-menu/proyek')->with('success', 'Berhasil Membuat Proyek Baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        $docs = FilePendukung::where('proyek_id', $proyek->id)->get();
        return view('dashboard.proyek.detailproyek',[
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
        return view ('dashboard.proyek.updateproyek',[
            'proyek' => $proyek
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
        // Delete file lama
        if ($proyek->files) {
            foreach ($proyek->files as $file) {
                Storage::delete($file->nama_file);
            }
        }

        // Upload file baru
        $docs = [];
        foreach ($request->file('nama_file') as $key => $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = $key.'-'.time().'.'.$extension;
            $path = $file->storeAs('uploads/docs', $filename);
            $docs[] = [
                'proyek_id' => $proyek->id,
                'nama_file' => $path,
            ];
        }
        // Insert file baru
        FilePendukung::insert($docs);
    }

    $proyek->update($validatedData);
    return redirect('/main-menu/proyek')->with('success', 'Berhasil Mengupdate Proyek');
}

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
