<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:buat user', ['only' => ['create', 'store']]);
        $this->middleware('permission:lihat user', ['only' => ['show']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hapus user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('dashboard.user.index', [
            'users' => $users
        ]);
        // $users = User::all();
        // return view('dashboard.user.index', [
        //     'users' => $users
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $roles = Role::all()->pluck('name', 'id');
        // return view('dashboard.user.create', [
        //     'roles' => $roles
        // ]);
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required|min:3|max:255',
                'email' => 'required|email:dns|unique:users,email',
                'password' => 'required|min:8|max:15|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
                // 'roles' => 'required|exists:roles,id',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = User::create($validatedData);

            // Ambil nama role berdasarkan ID
            // $roleName = Role::find($request->roles)->name;

            // Sinkronisasi role pada user
            // $user->syncRoles($roleName);
            $user->assignRole('user');
            return redirect('/main-menu/user')->with('success', 'User Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'name');
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('dashboard.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'username' => 'required|min:3|max:255',
                'password' => 'nullable|min:8|max:15|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
                'roles' => 'nullable',
            ]);

            $data = [
                'username' => $request->username,
                'email' => $request->email,
            ];
            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            }
            $user->update($data);
            if (!empty($request->roles)) {
                $user->syncRoles($request->roles);
            }
            return redirect('/main-menu/user')->with('success', 'User Berhasil Diperbarui!');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/main-menu/user')->with('success', 'User Berhasil Dihapus!');
    }
}
