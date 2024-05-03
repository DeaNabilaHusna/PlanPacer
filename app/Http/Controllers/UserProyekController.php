<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use App\Models\UserProyek;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
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
        $kolaborators = DB::table('user_proyeks')
            ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
            ->join('users', 'user_proyeks.user_id', '=', 'users.id')
            ->where('proyeks.user_id', $userId) //proyek milik pengguna saat ini
            ->select('users.email', 'users.username', 'users.id', 'proyeks.nama_proyek')
            ->get();

        return view('dashboard.user.index', compact('kolaborators'));

        // $userId = auth()->user()->id;
        // $kolaborators = User::find($userId)->proyeks()
        //     ->join('user_proyeks as up', 'proyeks.id', '=', 'up.proyek_id')
        //     ->join('users', 'up.user_id', '=', 'users.id')
        //     ->select('users.email', 'users.username', 'proyeks.nama_proyek', 'users.id as user_id')
        //     ->get();
        // $kolaborators->each(function ($kolaborator) {
        //     $user = User::find($kolaborator->user_id);
        //     $kolaborator->roles = $user ? $user->getRoleNames() : [];
        // });

        // return view('dashboard.user.index', compact('kolaborators'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(UserProyek $userProyek){
    //     dd ($userProyek);
    //     $kolaborator = $userProyek->user;

    // }
    public function edit(UserProyek $userProyek)
    {
        $userProyek = UserProyek::find(2);

        // $userProyek = UserProyek::find($userProyek->id);
        // dd ($userProyek);

        // Mendapatkan semua roles yang tersedia
        $roles = Role::pluck('name', 'id');

        return view('dashboard.user.edit', compact('roles', 'userProyek'));
    }
    //     public function edit(UserProyek $userProyek)
    // {
    //     $userId = auth()->user()->id;
    //     $userProyek = DB::table('user_proyeks')
    //         ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
    //         ->join('users', 'user_proyeks.user_id', '=', 'users.id')
    //         ->where('user_proyeks.id', $userProyek->id)
    //         ->where('proyeks.user_id', $userId)
    //         ->select('users.email', 'users.username', 'proyeks.nama_proyek', 'user_proyeks.id as user_proyek_id')
    //         ->first();
    // dd ($userProyek);

    //     // Mendapatkan semua roles yang tersedia
    //     $roles = Role::pluck('name', 'id');

    //     return view('dashboard.user.edit', compact('userProyek', 'roles'));
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProyekRequest $request, UserProyek $userProyek)
    {
        // // Mendapatkan user yang terkait dengan kolaborator
        // $user = $userProyek->user;

        // // Memperbarui roles untuk user
        // $user->syncRoles($request->roles);

        // return redirect()->route('dashboard.user.index')->with('success', 'Roles kolaborator berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProyek $userProyek)
    {
        //
    }
}
