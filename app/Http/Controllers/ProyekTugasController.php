<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use App\Models\KartuTugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TugasItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use GuzzleHttp\Handler\Proxy;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProyekTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $slug)
    {
        // Menggunakan $slug_proyek yang didapat dari URL
        $proyek = Proyek::where('slug', $slug)
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
        $tugas = KartuTugas::whereIn('proyek_id', $proyek->pluck('id'))->get();
        $tugas->load('tugasItems');


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
        $proyek = Proyek::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first();

        if (!$proyek) {
            abort(404); // Handle jika proyek tidak ditemukan
        }

        // Simpan slug proyek ke session
        session(['slug' => $slug]);

        return view('dashboard.modul.tambahproyektugas', [
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
            'nama_kartu' => [
                'required',
                'max:255',
                Rule::unique('kartu_tugas')->where(function ($query) use ($slug) {
                    return $query->where('proyek_id', Proyek::where('slug', $slug)->first()->id);
                }),
            ],
        ]);
        
        // Ambil proyek berdasarkan slug
        $proyek = Proyek::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first();

        if (!$proyek) {
            return redirect()->back()->withErrors(['slug' => 'Proyek tidak ditemukan.']);
        }
        $kartuSlug = Str::slug($validatedData['nama_kartu']) . '-' . $proyek->slug;
        
        // Simpan data kartu tugas baru ke database
        $validatedData['proyek_id'] = $proyek->id;
        $validatedData['slug'] = $kartuSlug; 
        $tugas = KartuTugas::create($validatedData);

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
        $proyek = Proyek::where('slug', $slug)->firstOrFail();
        $kartuTugas = KartuTugas::where('id', $id)->where('proyek_id', $proyek->id)->firstOrFail();

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
            'nama_kartu' => 'required|max:255',
        ]);

        $proyek = Proyek::where('slug', $slug)->firstOrFail();
        $kartuTugas = KartuTugas::where('id', $id)->where('proyek_id', $proyek->id)->firstOrFail();

        $kartuTugas->nama_kartu = $validatedData['nama_kartu'];
        $kartuTugas->save();

        return redirect('/main-menu/proyek/' . $proyek->slug . '/modul')->with('success', 'Modul berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, $slug, $kartuslug)
    {
        // Ambil proyek berdasarkan slug
        $proyek = Proyek::where('slug', $slug)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
            })->first();

        if (!$proyek) {
            abort(404); // Handle jika proyek tidak ditemukan
        }

        // Temukan kartu tugas dengan ID yang diberikan 
        $kartuTugas = KartuTugas::where('slug', $kartuslug)->where('proyek_id', $proyek->id)->first();

        if (!$kartuTugas) {
            abort(404); // Handle jika kartu tugas tidak ditemukan
        }

        $kartuTugas->delete();

        return redirect()->back()->with('success', 'Modul berhasil dihapus.');
    }
}
