<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function memberships()
    {
      return $this->hasMany('App\Membership');
    }

    public function users()
    {
      return $this->hasManyThrough('App\User', 'App\Membership', 'account_id', 'id');
    }

    public function ownerMembership()
    {
      return $this->hasOne('App\Membership')->where('role', 'owner');
    }

    public function owner()
    {
      return $this->ownerMembership->user;
    }

    public function url()
    {
      return 'accounts/'.$this->subdomain;
    }

    public function invitations()
    {
      return $this->hasMany('App\Invitation');
    }
}
