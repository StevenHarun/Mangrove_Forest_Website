<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.admin-dashboard');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
    // public function store(Request $request): RedirectResponse

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required','in:Pemda,User']
        ]);

        // Pastikan role yang diinginkan adalah Admin yang melakukan registrasi
        if ($request->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan registrasi.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        // dd('anda berhasil');

         // Mengarahkan pengguna ke halaman registrasi dengan pesan sukses
        // return redirect(route('register'))->with('success', 'Registrasi berhasil! Silakan masuk dengan akun baru Anda.');
        return redirect(route('register'))->with('success','Akun berhasil dibuat!');



    }
}
