<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('dashboard.role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd ($request);
        //
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);
        Role::create($validatedData);
        return redirect('/main-menu/role')->with('success', 'Role Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('dashboard.role.detail', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('dashboard.role.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name|max:255'. $role->id,
        ]);
        $role->update($validatedData);
        return redirect('/main-menu/role')->with('success', 'Role Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return redirect('/main-menu/role')->with('success', 'Role Berhasil Dihapus');
    }

    public function addPermissionsToRole($roleId){
        $permissions = Permission::get();
        $role = Role::findorFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
        // $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id);
        return view('dashboard.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function updatePermissionsToRole(Request $request, $roleId){
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findorFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'Hak Akses Berhasil Diberikan ke Role');
    }

    
}
