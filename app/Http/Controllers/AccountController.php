<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class AccountController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    /**
     */
    public function store(Request $request)
    {
        \Log::info($request->all());

        

        $user = new User;

        $user->name = $request->get('name');
        $user->subdomain = $request->get('subdomain');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
    }
}
