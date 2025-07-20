<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginView(Request $request){
        return view('auth.login');
    }

    public function loginProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            '*.exists' => ':attribute tidak terdaftar',
            '*.required' => ':attribute wajib diisi'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = User::where('username', $request->username)->first();
        if($user){
            if(!Hash::check($request->password, $user->password)){
                return redirect()->back()->with('error', 'Username atau password salah');
            }
            Auth::login($user, $request->remember_token ? true : false);
            toastr()->success('Selamat datang, '.$user->username);
            return redirect()->route('dashboard')->with('success', 'Selamat datang, '.$user->username);
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    public function logout(){
        Auth::logout();
        toastr()->success('Berhasil logout');
        return redirect()->route('auth.login.view');
    }
}
