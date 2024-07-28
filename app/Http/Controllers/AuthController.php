<?php

namespace App\Http\Controllers;

use App\Models\MJamaah;
use App\Models\UserAdminn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {
        if (session('data') && session('data')->role == 'user') {
            return redirect()->route('dashboard');
        }
        return view('auth/login', [
            'title' => 'Login | Jihadul Haq',
            'type' => 'user'
        ]);
    }

    public function log1n()
    {
        if (session('data') && session('data')->role == 'admin') {
            return redirect()->route('dashboard');
        }
        return view('auth/admin/login', [
            'title' => 'Login | Jihadul Haq',
            'type' => 'user'
        ]);
    }

    public function doLogin(Request $request)
    {
        try {
            if ($request->type == 'user') {
                $request->validate([
                    'no_hp' => 'required|string',
                    'password' => 'required|string'
                ]);

                $user = MJamaah::where('no_hp', $request->no_hp)->first();
                if ($user) {
                    if (Hash::check($request->password, $user->p4ss)) {
                        session(['data' => $user]);
                        return redirect()->route('user.home');
                    } else {
                        return back()->with('error', 'Password Anda salah, silahkan coba lagi');
                    }
                } else {
                    return back()->with('error', 'No Hp/Wa Anda belum terdaftar, silahkan hubungi admin');
                }
            } elseif ($request->type == 'admin') {
                $request->validate([
                    'username' => 'required|string',
                    'password' => 'required|string'
                ]);

                $user = UserAdminn::where('username', $request->username)->first();
                if ($user) {
                    if (Hash::check($request->password, $user->p4ssw0rd)) {
                        session(['data' => $user]);
                        return redirect()->route('dashboard');
                    } else {
                        return back()->with('error', 'Password Anda salah, silahkan coba lagi');
                    }
                } else {
                    return back()->with('error', 'Username tidak ditemukan, silahkan coba lagi');
                }
            }
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika mencoba login');
        }
    }

    public function logout(Request $request)
    {
        if (in_array(session('data')->role, ['admin', 'ketua', 'bendahara'])) {
            $locator = 'log1n';
        } else {
            $locator = 'login';
        }
        session()->forget('data');
        return redirect()->route($locator)->with('success', 'Anda telah logout');
    }
}
