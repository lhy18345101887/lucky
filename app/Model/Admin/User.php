<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AdminAuth;

class User extends AdminAuth
{

    protected $table = 'admin_users';

    protected $fillable = [
        'name','email','passwrod','api_token'
    ];




}
