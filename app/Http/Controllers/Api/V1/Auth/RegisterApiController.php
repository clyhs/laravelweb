<?php
/**
 * Created by PhpStorm.
 * User: clyhs
 * Date: 2017/10/1
 * Time: 18:11
 */
namespace App\Http\Controllers\Api\V1\Auth;

use App\User;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Dingo\Api\Exception\StoreResourceFailedException;
use Tymon\JWTAuth\Facades\JWTAuth;


class RegisterApiController extends BaseController{

    use RegistersUsers;

    public function register(Request $request)
    {
        $valid=$this->valid($request->all());    //验证表单
        if($valid->fails()){
            $this->sendFailResponse($valid->errors());
        }
        else{
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            if($user){
                $token=JWTAuth::fromuser($user);  //获取token
                return $this->response->array([
                    "token" => $token,
                    "message" => "Registration Success",
                    "status_code" => 201
                ]);
            }
            else{
                $this->sendFailResponse("Register Error");
            }
        }
    }
    public function valid($data)
    {
        return Validator::make($data,[
            'name'=>'required|unique:users|max:10',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6']);
    }
    public function sendFailResponse($message)
    {
        return $this->response->error($message,400);
    }

}