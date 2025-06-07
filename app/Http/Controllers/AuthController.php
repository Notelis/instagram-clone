<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // register user baru
    // endpointnya POST /api/register
    public function register(Request $request) // $request data yang dikirim lewat POST
    {
        // validasi input yang dikirim 
        // laravel validator bakal cek semua rule ini sebelum lanjut ke proses selanjutnya
        $request->validate([
        
            'username' => 'required|string|max:30|unique:users',
            // required = wajib ada, string = harus berupa text, max:30 = maksimal 30 karakter sesuai ketentuan instagram
            // unique:users cek ke table users, pastikan username ini belum ada yang pake

            'email' => 'required|string|email|max:255|unique:users',
            // email berarti laravel bakal validasi format email kyk harus ada @ dan domain yang valid
            // unique:users pastikan email belum terdaftar

            'password' => 'required|string|min:8|confirmed',
            // pw minimal 8 karakter
            // confirmed berarti laravel bakal nyari field 'password_confirmation' di request
            // dan memastikan valuenya sama persis dengan field 'password'
        ]);

        // kalau validasi berhasil, buat record user baru di database
        // laravel nanti otomatis isi created_at dan updated_at
        $user = User::create([
            // ambil value dari field 'username', 'email', 'password' di request
            'username' => $request->username, 
            'email' => $request->email, 
            'password' => Hash::make($request->password),  // Hash::make() menggunakan bcrypt untuk encrypt password
        ]);

        // return response JSON dengan HTTP status 201 
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user // isi data user yang baru dibuat
        ], 201);
    }

    // login user
    // endpoint POST /api/login
    public function login(Request $request)
    {
        // validasi input, butuh email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Auth::attempt() ambil email, cari user dengan email tsb di database, compare password yang dikirim dengan hashed password
        // return true atau false 
        if (!Auth::attempt($request->only('email', 'password'))) {
            // kalau login gagal, throw ValidationException (return error 422)
            throw ValidationException::withMessages([
                'email' => ['incorrect email or password.'],
            ]);
        }
        // kalau berhasil login, ambil data user yang baru login
        // setelah attempt() berhasil, set user ke session
        $user = Auth::user();
        
        // createToken() -> method dari Laravel Sanctum
        // utk generate token untuk user ini untuk authenticate API requests selanjutnya
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user, 
            'token' => $token 
        ]);
    }

    // logout user (hapus token)
    // endpoint POST /api/logout
    public function logout(Request $request)
    {
        // currentAccessToken() method dari Sanctum untuk dapetin token yang sedang dipake
        // delete() hapus token dari databas 
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    // get data user yang sedang login
    // endpoint GET /api/me
    public function me(Request $request)
    {
        // return data user yang ter-authenticate dari token yang dikirim
        return response()->json($request->user());
    }
 
}
