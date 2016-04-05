<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function memberships()
    {
        return $this->hasMany('App\Membership');
    }

    public function accounts()
    {
        return $this->hasManyThrough('App\Account', 'App\Membership', 'user_id', 'id');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function scopeFindByEmail($query, $email)
    {
        if($email != '') {
            return $query->where('email', $email)->first();
        }
        return false;
    }
}
