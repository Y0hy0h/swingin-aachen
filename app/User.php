<?php

namespace App;

use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'permissions'       => 'array',
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'last_login',
        'updated_at',
        'created_at',
    ];
}
