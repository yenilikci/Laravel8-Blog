<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth as FacadesAuth;

class Auth extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $request)
    {
        if (FacadesAuth::attempt(['email' => $request->email, 'password' => $request->password])){
            toastr()->success('Giriş Başarılı');
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı!');
        }
    }

    public function logout(){
        FacadesAuth::logout();
        return redirect()->route('admin.login');
    }

}
