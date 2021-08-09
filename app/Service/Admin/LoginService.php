<?php

namespace App\Service\Admin;

use App\Events\AdminLogin;
use App\Model\Admin\User;
use App\Service\BaseService;

class LoginService extends BaseService
{

    public function __construct()
    {

    }

    public function loginCheck($name,$password)
    {

        //验证账号数据库里是否有此人
        $user = User::where('name',$name)->first();
        if(!$user) return $this->codeError("用户未找到");

        event(new AdminLogin($name,request()->ip(),2,'密码错误'));

    }
}
