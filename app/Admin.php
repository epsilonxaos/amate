<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
