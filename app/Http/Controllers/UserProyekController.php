<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use App\Models\UserProyek;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserProyekRequest;
use App\Http\Requests\UpdateUserProyekRequest;

class UserProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        // $kolaborators = DB::table('user_proyeks')
        $userProyeks = DB::table('user_proyeks')

            ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
            ->join('users', 'user_proyeks.user_id', '=', 'users.id')
            ->where('proyeks.user_id', $userId) //proyek milik pengguna saat ini
            ->select('users.email', 'users.username', 'users.id as user_id', 'proyeks.nama_proyek', 'user_proyeks.id as id')
            ->get();

        return view('dashboard.user.index', compact('userProyeks'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProyekRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProyek $userProyek)
    {
        dd($userProyek);
        // return view('dashboard.user.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProyek $kolaborator)
    {
        $kolaborator = UserProyek::with('proyek')->find($kolaborator->id);
        // Log::info("Trying to edit UserProyek with ID: {$kolaborator->id} by user ID: " . auth()->user()->id);
        // dd ($kolaborator);
        $this->authorize('update', $kolaborator);
        $kolaborator = UserProyek::join('users', 'user_proyeks.user_id', '=', 'users.id')
        ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
        ->select('user_proyeks.*', 'users.email', 'proyeks.nama_proyek')
        ->where('user_proyeks.id', $kolaborator->id)
        ->first();

        $roles = Role::pluck('name', 'id');
        return view('dashboard.user.edit', [
            'kolaborator' => $kolaborator,
            'roles' => $roles,
        ]);
        // $userProyek = $kolaborator;
        // dd($kolaborator);
        // $kolaborator = $userProyek;
        // dd ($userProyek);

    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateUserProyekRequest $request, UserProyek $kolaborator)
    // {
    //     // $this->authorize('update', $kolaborator);
    //     // if (Auth::check() && Auth::user()->role === 'pic') {

    //         $validatedData = $request->validate([
    //             'roles' => 'required',
    //         ]);

    //         $validatedData = $request->validated();
    //         $kolaborator->roles()->sync($validatedData['roles']);
    //         // dd($kolaborator);

    //         // Redirect ke halaman yang sesuai
    //         // return redirect()->back()->with('success', 'Berhasil Mengubah Role Kolaborator');
    //         return redirect('/main-menu/kolaborator')->with('success', 'Berhasil Mengubah Role Kolaborator');
    //     // }
    // }
    public function update(UpdateUserProyekRequest $request, UserProyek $kolaborator)
    {
        $kolaborator = UserProyek::with('proyek')->find($kolaborator->id);
        // Otorisasi pengguna untuk melakukan update
        $this->authorize('update', $kolaborator);

        $validatedData = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Sinkronisasi peran kolaborator
        $kolaborator->roles()->sync($validatedData['roles']);

        return redirect('/main-menu/kolaborator')->with('success', 'Berhasil Mengubah Role Kolaborator');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProyek $userProyek)
    {
        //
    }
}
