<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function index()
    {
        return view('registrasi.registrasi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:15|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            'phone' => 'nullable|min:7|max:14',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        $user->assignRole('super admin');

        // dd('berhasil regis');
        return redirect('/login')->with('success', 'Registrasi Berhasil');
    }
}
