<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(App\Account $account, Request $request)
    {
      dd($account);
      $user = $request->user();
      $memberships = $user->memberships()->with('account')->get();
      return view('home')->with('memberships', $memberships);
    }
}
