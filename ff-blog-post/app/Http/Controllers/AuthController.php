<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6'
        ]);

        $checkEmailQuery = User::where('email', $request->email);

        if ($checkEmailQuery->count() === 1) {
            $user = $checkEmailQuery->first();

            $checkPassword = Hash::check($request->password, $user->password);

            if ($checkPassword) {
                Auth::login($user);

                return redirect('/');
            } else return redirect()->back()->withErrors(['password' => 'Invalid credentials']);
        } else return redirect()->back()->withErrors(['user' => 'User with given email doesn\'t exists']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|alpha',
            'surname' => 'required|string|alpha',
            'email' => 'required|email|unique:users',
            'thumbnail' => 'required|file|mimes:png,jpg,jpeg',
            'password' => 'required|string|confirmed|min:6'
        ]);


        $file = $request->file('thumbnail');

        $path = Storage::putFile('public/images', $file, 'public');

        $path = str_replace('public/', '', $path);
        $path = "uploads/{$path}";

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo' => $path
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    //
}
