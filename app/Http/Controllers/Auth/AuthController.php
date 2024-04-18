<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// <<<<<<< login
use Illuminate\Support\Facades\Session;
// =======
// >>>>>>> main

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

// <<<<<<< login
    public function login(Request $request)
// =======
//     public function authenticate(Request $request)
// >>>>>>> main
    {
//         $credentials = $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);

// <<<<<<< login
        $email = $credentials['email'];
        $password = $credentials['password'];

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->status == 1) {
                if (Auth::attempt($credentials)) {
                    $request->session()->remove('failed_attempts');
                    $request->session()->remove('last_failed_attempt');

                    $user = Auth::user();

                    if ($user->role) {
                        return redirect()->route('dashboard')
                            ->withSuccess('You have successfully logged in!');
                    }

                    return redirect()->intended('/');
                } else {
                    $failedAttempts = $request->session()->get('failed_attempts', 0);
                    $failedAttempts++;
                    $request->session()->put('failed_attempts', $failedAttempts);
                    $request->session()->put('last_failed_attempt', now());

                    if ($failedAttempts >= 3) {
                        $user->update(['status' => 2]);
                        return redirect()->back()->withErrors(['error' => 'Akun Anda telah diblokir Harap hubungi administrator untuk aktifkan akun anda']);
                    }

                    return redirect()->back()->withErrors(['loginError' => 'Login Gagal!'])->withInput();
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Akun Anda belum diaktifkan']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Email tidak terdaftar']);
        }
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function registerPost(Request $request)
    {
        $validatedData = $this->validate($request, [
            'nama'                   => 'required|unique:users,nama',
            'email'                  => 'required|email|unique:users,email',
            'password'               => 'required'
        ]);

        $defaultRole = RoleModel::where('nama_role', 'user')->first();

        $validatedData['otp_register'] = random_int(1000, 9999);
        $validatedData['password'] = bcrypt($request->password);
        $validatedData['id_role'] = $defaultRole->id_role;

        User::create($validatedData);
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('otpVerification');
    }

    public function otpVerification()
    {
        return view('pages.auth.otp');
    }

    public function otpVerificationPost(Request $request)
    {
        $request->validate([
            'otp_register' => 'required|numeric',
        ]);

        $user = Auth::user();

        if ($user->otp_register === $request->otp_register) {
            // Verifikasi sukses
            $user->otp_register = null;
            $user->save();

            Session::flash('Success', 'Verifikasi OTP berhasil.');
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'otp' => 'Kode OTP tidak valid.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
// // =======
//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();

//             return redirect()->intended('dashboard');
//         }

//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ])->onlyInput('email');
// >>>>>>> main
    }
}
