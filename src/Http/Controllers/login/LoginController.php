<?php

namespace Brightweb\Ecommerce\Http\Controllers\login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view("brightweb::frontend.login");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

}
