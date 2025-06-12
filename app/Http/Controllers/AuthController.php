<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'toko') {
                return redirect()->route('toko.produk.index');
            } elseif ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.produk');
            } elseif ($user->role === 'teknisi') {
                return redirect()->route('teknisi.dashboard');
            }

            return redirect()->route('landing'); // fallback
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:pelanggan,teknisi,toko',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('landing');
    }
}
