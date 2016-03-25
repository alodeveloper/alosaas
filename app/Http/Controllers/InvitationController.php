<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Event;
use Mail;
use AccountUtil;
use App\Account;
use App\Invitation;
use Validator;
use App\Events\InvitationSentEvent;

class InvitationController extends Controller
{
  public function create()
  {
    return view('invite.create');
  }

  public function store(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'email' => 'required|email|max:255'
    ]);
    if(!$validator->fails()) {
      $account = AccountUtil::current();
      if(!$account->users()->where('email', $data['email'])->first()) {
        $user = $request->user();
        $invitation = new Invitation;
        $invitation->email = $data['email'];
        $invitation->account_id = $account->id;
        $invitation->user_id = $user->id;
        $invitation->invitation_code = md5(uniqid(time(), true));
        $invitation->save();
        return redirect('users');
      } else {
        $request->session()->flash('danger', 'User already member of this account');
        return back()->withInput();
      }
    } else {
      return back()->withErrors($validator)->withInput();
    }
  }

  public function accept(Request $request)
  {
    // TODO: get the code from request, get the invitation with the code, if invitation available then check for the expiry date, if everything okay, then
  }
}
