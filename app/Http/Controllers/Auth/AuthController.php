<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\RoleModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'judul' => 'Halaman Login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

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
                        // return view('dashboard');
                        return redirect()->route('dashboard');
                        // ->withSuccess('You have successfully logged in!');
                    }

                    // return redirect()->intended('/');
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
        return view('pages.auth.register', [
            'judul' => 'Halaman Register',
        ]);
    }

    public function registerPost(Request $request)
    {
        $validatedData = $this->validate($request, [
            'nama'     => 'required|unique:users,nama',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $defaultRole = RoleModel::where('id_role', 2)->first();

        if (!$defaultRole) {
            $defaultRole = new RoleModel();
            $defaultRole->id_role = 2;
            $defaultRole->nama_role = 'Jamaah';
            $defaultRole->save();
        }

        $otpExpiry = now()->addMinutes(3);

        $otp = random_int(1000, 9999);

        $validatedData['otp_register'] = $otp;
        $validatedData['password'] = bcrypt($request->password);
        $validatedData['status'] = 1;
        $validatedData['id_role'] = 2;
        $validatedData['otp_expiry'] = $otpExpiry; // Atur waktu kedaluwarsa OTP

        $user = User::create($validatedData);

        if ($user) {
            Mail::to($user->email)->send(new OtpVerificationMail($user->otp_register));
            Auth::attempt($request->only('email', 'password'));
            return redirect()->route('otpVerification');
        } else {
            return back()->withErrors(['error' => 'Registrasi gagal.']);
        }
    }

    public function otpVerification()
    {
        if (Auth::check()) {
            return view('pages.auth.otp');
        } else {
            return redirect()->route('login');
        }
    }

    public function otpVerificationPost(Request $request)
    {
        $request->validate([
            'otp_register' => 'required|numeric',
        ]);

        $user = Auth::user();

        $otpExpiry = Carbon::parse($user->otp_expiry); // Ubah string menjadi objek Carbon

        if ($otpExpiry->isPast()) {
            // Jika OTP telah kedaluwarsa, buat OTP baru dan kirim ulang email
            $user->otp_register = random_int(1000, 9999);
            $user->otp_expiry = Carbon::now()->addMinutes(3);
            $user->save();

            Mail::to($user->email)->send(new OtpVerificationMail($user->otp_register));

            Session::flash('Error', 'Kode OTP telah kedaluwarsa. Kode OTP baru telah dikirim ulang.');
            return view('pages.auth.otp_expired');
        }

        if ($user->otp_register == $request->otp_register) {
            $user->otp_register = null;
            $user->save();

            Session::flash('Success', 'Verifikasi OTP berhasil.');
            return redirect()->route('dashboard');
        } else {
            // Session::flash('Error', 'Kode OTP tidak valid.');
            // return back();
            return redirect()->back()->withErrors(['Error' => 'Kode OTP tidak valid']);
        }
    }

    public function generateNewOTP(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->otp_register = random_int(1000, 9999);
            $user->otp_expiry = Carbon::now()->addMinutes(3); // Atur waktu kedaluwarsa 3 menit dari sekarang
            $user->save();

            Mail::to($user->email)->send(new OtpVerificationMail($user->otp_register));

            Session::flash('Success', 'Kode OTP baru telah dikirim.');
            return redirect()->route('otpVerification');
        } else {
            // Pengguna belum diotentikasi, arahkan ke halaman login
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
