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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('checkRole:pic'); // Hapus atau sesuaikan ini jika diperlukan
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $kolaborators = DB::table('user_proyeks')
        ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
        ->join('users', 'user_proyeks.assignee_user_id', '=', 'users.id')
        ->leftJoin('roles', 'user_proyeks.role_id', '=', 'roles.id')
        ->where('proyeks.user_id', $userId)
        ->select(
            'users.email', 
            'users.username', 
            'users.id as assignee_user_id', 
            'proyeks.nama_proyek', 
            'user_proyeks.id as id', 
            'roles.name as role_name' 
        )
        ->get();

        return view('dashboard.user.index', compact('kolaborators'));
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
        // return $kolaborator;
        $kolaborator = UserProyek::with('proyek', 'roles')->find($kolaborator->id);
        Log::info("Trying to edit UserProyek with ID: {$kolaborator->id} by user ID: " . auth()->user()->id);
        // dd ($kolaborator);
        $this->authorize('update', $kolaborator);
        $kolaborator = UserProyek::join('users', 'user_proyeks.assignee_user_id', '=', 'users.id')
        ->join('proyeks', 'user_proyeks.proyek_id', '=', 'proyeks.id')
        ->select('user_proyeks.*', 'users.email', 'proyeks.nama_proyek')
        ->where('user_proyeks.id', $kolaborator->id)
        ->first();

        $roles = Role::pluck('name', 'id');
        return view('dashboard.user.edit', [
            'kolaborator' => $kolaborator,
            'roles' => $roles,
        ]);

    }
    /**
     * Update the specified resource in storage.
     */
     public function update(UpdateUserProyekRequest $request, UserProyek $kolaborator)
    {
        // Log::info('Update method called for UserProyek ID: ' . $kolaborator->id);
        $this->authorize('update', $kolaborator);
    
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id', // Ubah validasi role_id
        ]);
    
        $kolaborator->update([
            'role_id' => $validatedData['role_id'],
            'assigned_by_user_id' => auth()->user()->id,
        ]);
    
        return redirect('/main-menu/kolaborator')->with('success', 'Berhasil Mengubah Role Kolaborator');
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProyek $kolaborator)
    {
        // dd ($userProyek);
        $this->authorize('delete', $kolaborator);
            $kolaborator->delete();
            return redirect('/main-menu/kolaborator')->with('success', 'Berhasil Menghapus Kolaborator');
       
    }
   
}
