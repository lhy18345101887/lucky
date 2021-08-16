<?php

namespace App\Service\Admin;

use App\Events\LoginEvent;
use Illuminate\Support\Facades\Auth;
use App\Events\AdminLogin;
use App\Model\Admin\User;
use App\Model\Admin\LoginLog;
use App\Service\BaseService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;


class LoginService extends BaseService
{

    use AuthenticatesUsers;

    public function __construct()
    {

    }

    public function loginCheck($name,$password)
    {
        $user = User::where('name', $name)->first();

        if(!$user) return $this->codeError('查无此人');

        if (!password_verify($password, $user->password)) {

            return $this->codeError('抱歉，账号名或者密码错误！');

        }

        event(new AdminLogin($name,request()->ip(),1,"登录成功"));

        $api_token = Str::random(80);

        $user->update(['api_token' => hash('sha256', $api_token)]);

        return $this->codeSuccess('登录成功',compact('api_token'));
    }
}
