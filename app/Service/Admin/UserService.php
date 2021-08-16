<?php

namespace App\Service\Admin;

use Illuminate\Support\Facades\Auth;
use App\Model\Admin\User;
use App\Service\BaseService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;


class UserService extends BaseService
{

    public function __construct()
    {

    }

    public function getUserInfo($api_token)
    {
        $name  = Auth::id();
        $avatar ='https://avatars.githubusercontent.com/u/58757551?s=60&v=4';
        $user = User::where('id', Auth::id())
            ->first();

        return $this->codeSuccess('获取用户信息成功',array('name'=>$user->name,'avatar'=>$avatar));

    }
}
