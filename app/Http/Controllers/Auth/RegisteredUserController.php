<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function generateIdUser()
    {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'no_telp' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => 'required|captcha'
        ]);

        // Generate a unique ID for the user ID
        $idUser = $this->generateIdUser();

        $user = User::create([
            'id' => $idUser,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        Alert::success('Registrasi Berhasil');
        return redirect()->route('verification.notice');
    }
}
