<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function hasAccess($permission)
    {
        return $this->hasPermission($permission);
    }

    private function hasPermission($permission)
    {
        return isset($this->permissions[$permission]) ? $this->permissions[$permission] : false;
    }
}
