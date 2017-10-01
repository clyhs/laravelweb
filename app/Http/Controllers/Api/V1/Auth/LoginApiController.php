<?php
/**
 * Created by PhpStorm.
 * User: clyhs
 * Date: 2017/10/1
 * Time: 18:40
 */
namespace App\Http\Controllers\Api\V1\Auth;

use App\User;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginApiController extends BaseController{

    use AuthenticatesUsers;
    public function login(Request $request)
    {
        $user=User::where('name',$request->email)->orwhere('email',$request->email)->firstOrFail();
        if($user && Hash::check($request->password,$user->password)){
            $token=JWTAuth::fromuser($user);    //获取token
            $this->clearLoginAttempts($request);  //清除登录次数
            return $this->response->array([
                'token'=>$token,
                'message'=>"Login Success",
                'status_code'=>200
            ]);
        }
        else{
            throw new UnauthorizedHttpException("Login Failed");
        }
    }
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());    //token加入黑名单(注销)
        $this->guard()->logout();
    }
}