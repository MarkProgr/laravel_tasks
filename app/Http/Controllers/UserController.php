<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteUser\LoginRequest;
use App\Http\Requests\SiteUser\SignUpRequest;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUpForm()
    {
        return view('site-users.sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $data = $request->validated();

        $siteUser = new User($data);
        $siteUser->save();

        return redirect()->route('login.form');
    }

    public function loginForm()
    {
        return view('site-users.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $currentUser = User::query()->where('login', '=', $credentials['login'])->first();

        if (! $currentUser || ! Hash::check($credentials['password'], $currentUser->password)) {
            session()->flash('error', 'Invalid password or login');

            return redirect()->route('login');
        }

        Auth::attempt($credentials, true);

        $currentUser->last_visited = new DateTime();
        $currentUser->save();

        return redirect()->route('main');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
