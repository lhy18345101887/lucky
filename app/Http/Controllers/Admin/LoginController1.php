<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Admin\LoginService;

class LoginController1 extends Controller
{

    private $service = null;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){

            $name = $request->input('name');
            $password = $request->input('password');

            return $this->service->loginCheck($name,$password);
        }
    }
}
