<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Event;
use Mail;
use AccountUtil;
use App\Account;
use App\User;
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
    // TODO: get the code from request, get the invitation with the code, if invitation available then check for the expiry date, if everything okay, then create user and assign to account.
    $code = $request->get('code');
    if($code) {
      $invitation = Invitation::OfCode($code)->first();
      if($invitation) {
        dd($invitation);
        $joiningUser = User::findByEmail($invitation->email);
        $account = $invitation->account();
        if(!$joiningUser) {
          return view('invite.join');
        }
      } else {
        $request->session()->flash('Invitation code is expired or invalid');
      }
    } else {
      $request->session()->flash('Invitation code is expired or invalid');
    }
    return view('invite.accept');
  }

  public function joinAccount(Request $request)
  {
    $code = $request->get('code');
    if($code) {
      $invitation = Invitation::findByCode($code);
      if($invitation) {
        // TODO: get the account to which the user should be joined. find the user in the database, if not then create the user and attach to the account.
        $joiningUser = User::findByEmail($invitation->email);
        $account = $invitation->account();
        if(!$joiningUser) {
          $joiningUser = new User;
          $joiningUser->name = $request->get('name');
          $joiningUser->email = $invitation->email;
          $joiningUser->password = bcrypt($request->get('password'));
          $joiningUser->account_id = $account->id;
          $joiningUser->save();
        }

        $membership = new Membership;
        $membership->user_id = $joiningUser->id;
        $membership->role = 'member';
        $account->memberships()->save($membership);

        $invitation->invitation_accepted_at = Carbon::now();
        $invitation->save();

        Auth::login($joiningUser);
      }
    }
  }
}
