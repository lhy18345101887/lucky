<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'admin_login_logs';

    protected $fillable = [
        'name','ip','type','msg'
    ];

}
