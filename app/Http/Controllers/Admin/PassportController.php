<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\User;
use App\Service\Admin\LoginService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    //

    protected $clientId;
    protected $clientSecret;
//    private $service = null;

    public function __construct()
    {
//        $this->service = $service;
        $this->middleware('auth')->except('login', 'register', 'refresh','create');
        $client = \DB::table('oauth_clients')->where('id', 2)->first();

        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;
    }

    protected function username()
    {
        return 'email';
    }

    public function register()
    {
        $this->validator(request()->all())->validate();

        $this->create(request()->all());

        return $this->getToken();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users',],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function create()
    {
        $data = $this->validator(request()->all())->validate();

        return User::forceCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }

//    public function logout(Request $request)
//    {
//        auth()->user()->token()->revoke(); // 只会使 access_token 失效
//
//        return ['message' => '退出登录成功'];
//    }


    public function logout()
    {
        $tokenModel = auth()->user()->token();
        $tokenModel->update([
            'revoked' => 1,
        ]);

        \DB::table('oauth_refresh_tokens')
            ->where(['access_token_id' => $tokenModel->id])->update([
                'revoked' => 1,
            ]);

        return ['message' => '退出登录成功'];
    }

    public function login()
    {
        $user = User::where($this->username(), request($this->username()))
            ->firstOrFail();
        if (!password_verify(request('password'), $user->password)) {
            return response()->json(['error' => '抱歉，账号名或者密码错误！'],
                403);
        }

        return $this->getToken();
    }

    public function refresh()
    {
        $response = (new Client())->post('http://www.llll.com/api/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => request('refresh_token'),
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => '*',
            ],
        ]);

        return $response;
    }

    /**
     * @param Request $request
     * @param Client  $guzzle
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function getToken()
    {
        $response = (new Client())->post('http://www.llll.com/api/oauth/token', [

            'form_params' => [
                'grant_type' => 'password',
                'username' => request('email'),
                'password' => request('password'),
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => '*',
            ],
        ]);

        return $response->getBody();
    }
}
