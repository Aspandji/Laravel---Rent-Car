<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->status != 'active') {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'Failed');
                Session::flash('message', 'Your Account is not active yet. Please contact your Administrator');
                return redirect('/login');
            }

            //dd(Auth::user());

            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('/');
            }
        }

        Session::flash('status', 'Failed');
        Session::flash('message', 'Login Invalid');
        return redirect('/login');
    }

    public function register()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $validatedData = $request->validate([
            'username' => 'required|min:3|max:25|unique:users',
            'password' => 'required|min:8|max:255',
            'phone'    => 'numeric|min:10',
            'address'  => 'required'
        ]);

        // $user = User::create($request->all());

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        Session::flash('status', 'Succsess');
        Session::flash('message', 'Regist Success. Wait for Approval Your Account');
        return redirect('/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
