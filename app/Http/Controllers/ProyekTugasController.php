<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use App\Models\KartuTugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TugasItem;
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Handler\Proxy;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProyekTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $proyek = Proyek::where('user_id', Auth::id())
    //         ->orWhereHas('users', function ($query) {
    //             $query->where('users.id', Auth::id());
    //         })->get();
    //     $tugas = KartuTugas::all();
    //     return view('dashboard.tugas.proyektugas', [
    //         'tugas' => $tugas,
    //         'proyek' => $proyek,
    //     ]);
    // }

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


        return view('dashboard.tugas.proyektugas', [
            'tugas' => $tugas,
            'proyek' => $proyek,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //     session(['nama_proyek' => $request->nama_proyek]);
    //     $users = User::all();
    //     $proyeks = Proyek::all();
    //     return view('dashboard.tugas.tambahproyektugas', [
    //         'users' => $users,
    //         'proyeks' => $proyeks,
    //     ]);
    // }
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

        $users = User::all(); // Ambil semua user (jika diperlukan)

        // Simpan slug proyek ke session
        session(['slug' => $slug]);

        return view('dashboard.tugas.tambahproyektugas', [
            'proyek' => $proyek,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validasi data input
    //     $validatedData = $request->validate([
    //         'nama_tugas' => 'required|max:255',
    //     ]);

    //     $validatedData['user_id'] = auth()->user()->id;
    //     $namaProyek = session('nama_proyek');
    //     if (!$namaProyek) {
    //         return redirect()->back()->withErrors(['nama_proyek' => 'Nama proyek tidak ditemukan dalam session.']);
    //     }
    //     // dd('nama_proyek');
    //     // Simpan data kartu tugas baru ke database
    //     $validatedData['nama_proyek'] = $namaProyek;
    //     $tugas = KartuTugas::create($validatedData);
    //     $tugasId = $tugas->id;
    //     // KartuTugas::create($validatedData); //diubah//


    //     // Redirect ke halaman index dengan pesan sukses
    //     return redirect()->back()->with('success', 'Kartu Tugas berhasil dibuat. ID Tugas: '. $tugasId);
    // }
    public function store(Request $request, $slug)
    {
        try {
            $validatedData = $request->validate([
                'nama_kartu' => 'required|max:255',
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

            // Simpan data kartu tugas baru ke database
            // $validatedData['user_id'] = auth()->user()->id;
            $validatedData['proyek_id'] = $proyek->id; // Assign proyek_id dari proyek yang ditemukan
            $tugas = KartuTugas::create($validatedData);

            // Redirect ke halaman index dengan pesan sukses
            return redirect('/main-menu/proyek/'. $slug .'/tugas')->with('success', 'Berhasil Membuat Proyek Baru'. $tugas->id);
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
        // // Temukan kartu tugas dengan ID yang diberikan
        // $proyektugas = ProyekTugas::findOrFail($id);

        // Tampilkan halaman detail kartu tugas
        // return view('tugas.show', ['kartuTugas' => $proyektugas]);
        return view('dashboard.tugas.editproyektugas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan kartu tugas dengan ID yang diberikan
        // $kartuTugas = ProyekTugas::findOrFail($id);

        // Tampilkan form untuk mengedit kartu tugas
        // return view('tugas.edit', ['kartuTugas' => $kartuTugas]);
        $users = User::all();
        return view('dashboard.tugas.editproyektugas', [
            // 'proyek' => $proyek,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_tugas' => 'required|max:255',
            'tgl_mulai_proyek' => 'required',
            'tgl_selesai_proyek' => 'required',
            'status_proyek' => 'required',
            'deskripsi_proyek' => 'nullable',
        ]);

        // Temukan dan perbaharui kartu tugas dengan ID yang diberikan
        KartuTugas::findOrFail($id)->update($validatedData);
        // $validatedData['user_id'] = auth()->user()->id;

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('proyektugas')->with('success', 'Kartu Tugas berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        // Temukan dan hapus kartu tugas dengan ID yang diberikan
        KartuTugas::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('proyektugas')->with('success', 'Kartu Tugas berhasil dihapus.');
    }
}
