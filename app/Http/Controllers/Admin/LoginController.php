<?php

// email 设置可为空
// request 和 response 都是 json 格式
// api_token 设置可插入数据库

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Service\Admin\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    private $service = null;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
        $this->middleware('auth:admin')->except('login', 'register','create');
    }

    protected function username()
    {
        return 'name';
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $api_token = Str::random(80);
        $data = array_merge($request->all(), compact('api_token'));
        $this->create($data);

        return compact('api_token');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users',],
//            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(Request $request)
    {

        $api_token = Str::random(80);
        $data = array_merge($request->all(), compact('api_token'));
//        print_r($data);exit();
        return User::forceCreate([
            'name' => $data['name'],
//            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'api_token' => hash('sha256', $data['api_token']),
        ]);
    }

    public function logout()
    {
        Auth::user()->update(['api_token' => null]);

        return $this->codeSuccess('成功');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){

            $name = $request->input('username');
            $password = $request->input('password');

            return $this->service->loginCheck($name,$password);
        }

    }

    public function refresh()
    {
        $api_token = Str::random(80);
        auth()->user()->update(['api_token' => hash('sha256', $api_token)]);

        return compact('api_token');
    }
}
