<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function hasAccess($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permission)) {
                return true;
            }
        }
        return false;
    }

    public function inRole($roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }
}
