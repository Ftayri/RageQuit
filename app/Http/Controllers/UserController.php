<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function login(Request $data)
    {
        $valdiator=$data->validate([
            'username' => 'required|string',
            'password' => 'required|min:8'
        ]);
        if (Auth::attempt(['name' => $data['username'], 'password' => $data['password']], $data['remember'])) {
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['error' => 'Invalid username or password']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $data
     * @return \App\Models\User
     */
    protected function register(Request $data)
    {
        $validator=Validator::make($data->all(), [
            'username_signup' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_signup' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
            $user=User::create([
            'name' => $data['username_signup'],
            'email' => $data['email'],
            'password' => Hash::make($data['password_signup']),
        ]);
        Auth::login($user, $data['remember']);
        //stay on same page without reloading
        return redirect()->back();
    }
}
