<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Service\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    private $service = null;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('auth:admin');
    }

    public function getUserInfo(Request $request)
    {
        $api_token = $request->input('token');
        
        return $this->service->getUserInfo($api_token);
    }
}
