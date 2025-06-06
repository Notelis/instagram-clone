<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // register user baru
    // endpointnya POST /api/register
    public function register(Request $request)
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
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Hash::make() menggunakan bcrypt untuk encrypt password
        ]);

        // return response JSON dengan HTTP status 201 
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

 
}
