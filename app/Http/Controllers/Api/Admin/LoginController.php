<?php


namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\PostLoginRequest;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api
 */
class LoginController extends Controller
{

    public $successStatus = 200;

    public function login(PostLoginRequest $request)
    {
        if(auth()->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = auth()->user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json( $success, $this->successStatus);
        }
        else{
            return response()->json(['data'=>['message'=>'Invalid email or password']], 401);
        }

    }

}