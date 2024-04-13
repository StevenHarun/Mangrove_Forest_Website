<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminRegistrationController extends Controller
{   
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.admin-dashboard'); // Sesuaikan dengan nama tampilan registrasi Anda
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required','in:Pemda,User'] // Tambahkan validasi untuk role
        ]);

        // Pastikan role yang diinginkan adalah Admin yang melakukan registrasi
        if ($request->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan registrasi.');
        }

        // Buat pengguna baru dengan peran yang ditentukan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        // event(new Registered($user));

        // Redirect ke halaman atau berikan respons yang sesuai
        // return redirect()->route('home')->with('success', 'User berhasil ditambahkan!');
        // dd('Regist Berhasil');
        dd('adminRegist');
    }
}
