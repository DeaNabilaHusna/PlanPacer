<?php

namespace App\Http\Controllers;

use App\Models\TugasItem;
use App\Models\Proyek;
use App\Models\UserTugasitem;
use App\Models\User;
use App\Models\UserProyek;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\KartuTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TugasItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        // Ambil KartuTugas berdasarkan slug
        $kartuTugas = KartuTugas::where('slug', $slug)->first();

        if (!$kartuTugas) {
            abort(404, 'Kartu Tugas tidak ditemukan');
        }

        // Ambil semua Tugas Item yang terkait dengan Modul
        $tugasItems = $kartuTugas->tugasItems;

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
        $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = KartuTugas::where('slug', $modulslug)->first();
        $kolaborator = UserProyek::where('proyek_id', $proyek->id)
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
                'nama_tugas_item' => [
                    'required',
                    'max:255',
                    Rule::unique('tugas_items')->where(function ($query) use ($proyekslug, $modulslug) {
                        $proyek = Proyek::where('slug', $proyekslug)->first();
                        $kartuTugas = KartuTugas::where('slug', $modulslug)->first();
                        return $query->where('proyek_id', $proyek->id)
                            ->where('kartu_id', $kartuTugas->id);
                    }),
                ],
                'deskripsi_tugas_item' => 'nullable',
                'status_tugas_item' => 'required',
                'tgl_mulai_tugas' => 'required|date',
                'tgl_selesai_tugas' => 'required|date',
                // 'penanggungjawab_id' => 'required|array',
                'penanggungjawab_id.*' => 'exists:users,id',
            ]);

            // Cari proyek berdasarkan slug
            $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();

            // Cari kartu tugas berdasarkan slug
            $kartuTugas = KartuTugas::where('slug', $modulslug)->firstOrFail();

            if ($proyek->visibilitas === 'private' && empty($validatedData['penanggungjawab_id'])) {
                $validatedData['penanggungjawab_id'] = [auth()->user()->id];
            }
            $slug = Str::slug($validatedData['nama_tugas_item']) . '-' . Str::random(5);

            $tugasItem = new TugasItem();
            $tugasItem->proyek_id = $proyek->id;
            $tugasItem->kartu_id = $kartuTugas->id;
            $tugasItem->nama_tugas_item = $validatedData['nama_tugas_item'];
            $tugasItem->deskripsi_tugas_item = $validatedData['deskripsi_tugas_item'];
            $tugasItem->status_tugas_item = $validatedData['status_tugas_item'];
            $tugasItem->tgl_mulai_tugas = $validatedData['tgl_mulai_tugas'];
            $tugasItem->tgl_selesai_tugas = $validatedData['tgl_selesai_tugas'];
            $tugasItem->slug = $slug;
            $tugasItem->save();

            // Simpan penanggung jawab 
            foreach ($validatedData['penanggungjawab_id'] as $userId) {
                $user = User::findOrFail($userId);

                UserTugasitem::create([
                    'penanggungjawab_id' => $userId,
                    'proyek_id' => $proyek->id,
                    // 'tugas_item_id' => $tugasItem->id,
                    'modul_id' => $kartuTugas->id,
                    'email_penanggungjawab' => $user->email,
                ]);
            }

            return redirect("/main-menu/proyek/{$proyek->slug}/modul")
                ->with('success', 'Tugas berhasil ditambahkan ke Modul.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TugasItem $tugasItem, $proyekslug, $modulslug, $tugasslug)
    {
        dd($tugasItem);
        $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
        $modul = KartuTugas::where('slug', $modulslug)->firstOrFail();
        $tugasItem = TugasItem::where('slug', $tugasslug)->firstOrFail();
        $penanggungjawabs = DB::table('user_tugasitems')
        ->join('users', 'user_tugasitems.penanggungjawab_id', '=', 'users.id')
        ->where('user_tugasitems.proyek_id', $proyek->id)
        ->where('user_tugasitems.modul_id', $modul->id)
        ->where('tugas_items.slug', $tugasItem->slug) // Pastikan nama tabel dan kolomnya sesuai dengan struktur tabel Anda
        ->select('users.*') // Anda dapat memilih kolom yang ingin Anda ambil dari tabel users
        ->get();
    
        // dd($tugasItem);
        return view('dashboard.tugas.detail', compact('tugasItem', 'proyek', 'modul', 'penanggungjawabs'));
    }

//     public function show($proyekslug, $modulslug, $tugasslug)
// {
//     try {
//         // Temukan proyek berdasarkan slug
//         $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();

//         // Temukan modul kartu tugas berdasarkan slug
//         $modul = KartuTugas::where('slug', $modulslug)->firstOrFail();

//         // Temukan tugas item berdasarkan slug
//         $tugasItem = TugasItem::where('slug', $tugasslug)->firstOrFail();

//         // Muat relasi users untuk mendapatkan penanggung jawab
//         $tugasItem->load('users');

//         // Ambil penanggungjawab ID dari relasi
//         $penanggungjawabIds = $tugasItem->users->pluck('id')->toArray();

//         // Tampilkan view dengan data yang diperlukan
//         return view('dashboard.tugas.detail', compact('tugasItem', 'proyek', 'modul', 'penanggungjawabIds'));
//     } catch (\Exception $e) {
//         Session::flash('error', $e->getMessage());
//         return back()->withInput();
//     }
// }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TugasItem $tugasItem, $proyekslug, $modulslug, $tugasslug)
    {
        // $this->authorize('update', $tugasItem);

        $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
        $kartuTugas = KartuTugas::where('slug', $modulslug)->firstOrFail();
        $tugasItem = TugasItem::where('slug', $tugasslug)->firstOrFail();
        $kolaborator = UserProyek::where('proyek_id', $proyek->id)
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
    public function update(Request $request, TugasItem $tugasItem, $proyekslug, $modulslug, $tugasItemSlug)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'nama_tugas_item' => [
                    'required',
                    'max:255',
                    Rule::unique('tugas_items')->ignore($tugasItemSlug, 'slug')->where(function ($query) use ($proyekslug, $modulslug) {
                        $proyek = Proyek::where('slug', $proyekslug)->first();
                        $kartuTugas = KartuTugas::where('slug', $modulslug)->first();
                        return $query->where('proyek_id', $proyek->id)
                            ->where('kartu_id', $kartuTugas->id);
                    }),
                ],
                'deskripsi_tugas_item' => 'nullable',
                'status_tugas_item' => 'required',
                'tgl_mulai_tugas' => 'required|date',
                'tgl_selesai_tugas' => 'required|date',
                'penanggungjawab_id.*' => 'exists:users,id',
            ]);

            // Cari proyek, kartu tugas, dan tugas item berdasarkan slug
            $proyek = Proyek::where('slug', $proyekslug)->firstOrFail();
            $kartuTugas = KartuTugas::where('slug', $modulslug)->firstOrFail();
            $tugasItem = TugasItem::where('slug', $tugasItemSlug)->firstOrFail();
            if ($proyek->visibilitas === 'private' && empty($validatedData['penanggungjawab_id'])) {
                $validatedData['penanggungjawab_id'] = [auth()->user()->id];
            }
            $slug = Str::slug($validatedData['nama_tugas_item']) . '-' . Str::random(5);

            $tugasItem->nama_tugas_item = $validatedData['nama_tugas_item'];
            $tugasItem->deskripsi_tugas_item = $validatedData['deskripsi_tugas_item'];
            $tugasItem->status_tugas_item = $validatedData['status_tugas_item'];
            $tugasItem->tgl_mulai_tugas = $validatedData['tgl_mulai_tugas'];
            $tugasItem->tgl_selesai_tugas = $validatedData['tgl_selesai_tugas'];
            $tugasItem->slug = $slug;
            $tugasItem->save();

            // Hapus penanggung jawab yang lama
            UserTugasitem::where('id', $tugasItem->id)->delete();

            // Simpan penanggung jawab yang baru
            foreach ($validatedData['penanggungjawab_id'] as $userId) {
                $user = User::findOrFail($userId);

                UserTugasitem::create([
                    'tugas_item_id' => $tugasItem->id,
                    'penanggungjawab_id' => $userId,
                    'proyek_id' => $proyek->id,
                    'modul_id' => $kartuTugas->id,
                    'email_penanggungjawab' => $user->email,
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
    public function destroy(TugasItem $tugasItem, $proyekslug, $modulslug, $tugasItemSlug)
    {
        try {
            $tugasItem = TugasItem::where('slug', $tugasItemSlug)->firstOrFail();
            $tugasItem->delete();

            return redirect("/main-menu/proyek/{$proyekslug}/modul")
                ->with('success', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();
        }
    }
}
