<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AdminAuth;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends AdminAuth
{
    use Notifiable,HasApiTokens;

    protected $table = 'admin_users';

    protected $fillable = [
        'name','email','passwrod','api_token'
    ];




}
