<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Event;
use App\Events\InvitationSentEvent;
use Carbon\Carbon;

class Invitation extends Model
{
  public function account()
  {
    return $this->belongsTo('App\Account');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function scopeNotExpired($query, $account_id = 0)
  {
    if($account_id > 0) {
      $query = $query->where('account_id', $account_id);
    }
    $query = $query->where('invitation_expire_at', '>', Carbon::now());
  }

  public function scopeNotAccepted($query, $account_id = 0)
  {
    if($account_id > 0) {
      $query = $query->where('account_id', $account_id);
    }
    return $query->whereNull('invitation_accepted_at');
  }

  public function scopeOfCode($query, $code)
  {
    if($code != '') {
      return $query->where('invitation_code', $code)->where('invitation_expire_at', '<', Carbon::now())->whereNull('invitation_accepted_at');
    }
    return false;
  }
}

Invitation::created(function($invitation) {
  // send mail to invited email address with url for logging in.

  Event::fire(new InvitationSentEvent($invitation));
});
