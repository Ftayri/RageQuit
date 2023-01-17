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
        $valdiator=Validator::make($data->all(), [
            'username' => 'required|string',
            'password' => 'required|min:8'
        ]);
        if($valdiator->fails()){
            return redirect()->back()->withErrors($valdiator,'loginErrors');
        }
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
            return redirect()->back()->withErrors($validator,'registerErrors');
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
    public function profileEdit(){
        if(auth()->check()){
            $user=auth()->user();
            $username=$user->name;
            $email=$user->email;

            return view('user.profile-edit',compact('username','email'));
        }
        return redirect()->route('home');
    }
    public function update(Request $request){
        if($request->input('password')){
            //validate password and check if old password matches current user password
            $validator=Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator,'profileErrors');
            }
            $password=$request->input('password');
            $user=User::where('email',auth()->user()->email)->first();
            $user->password=Hash::make($password);
            $user->save();
            return redirect()->back()->with('success','Password updated successfully');
        }
        else{
            $validator=Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator,'profileErrors');
            }
            $username=$request->input('name');
            $email=$request->input('email');
            //get user from database where email is equal to current user email
            $user=User::where('email',auth()->user()->email)->first();
            $user->name=$username;
            $user->email=$email;
            $user->save();
            return redirect()->back()->with('success','Profile updated successfully');
        }

    }
}
