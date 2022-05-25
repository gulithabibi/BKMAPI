<?php

namespace App\Services;

use App\Models\User;
use App\Models\DriverAccess;
use App\Libraries\ApiResponse;
use Illuminate\Support\Facades\Hash;


class AuthServices
{
    public function register($request){
        if(!AuthServices::headerValid($request)){
            return ApiResponse::getUnauthorizedResponse(config('global.error_message.api_key_not_valid'));
        }

        $fields=$request->validate([
            'email'=>'required|string|unique:user,email',
            'password'=>'required|string|confirmed|min:6',
            'username'=>'required|string|unique:user|min:4',
            'full_name'=>'required|string',
            'phone'=>'string',
            'address'=>'string',
        ]);

        $user=User::create([
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
            'username'=>$fields['username'],
            'full_name'=>$fields['full_name'],
            'phone'=>$fields['phone'],
            'address'=>$fields['address'],

        ]);

        $token=$user->createToken(config('global.default_device_name'))->plainTextToken;

        $data=array(
            "user"=>$user,
            "token"=>$token
        );
        return ApiResponse::getCreatedResponse($data);
     }
    public function login($request){
        if(!AuthServices::headerValid($request)){
            return ApiResponse::getUnauthorizedResponse(config('global.error_message.api_key_not_valid'));
        }

        //validate
        $fields=$request->validate([            
            'username'=>'required|string',
            'password'=>'required|string',
            'device_name'=>'',
            'is_admin'=>''
        ]);

        if(isset($fields['is_admin']) && $fields['is_admin']==false){
            //check username
            $user=DriverAccess::where('username',$fields['username'])->first();
        }else{
            //check username
            $user=User::where('username',$fields['username'])->first();
        }

        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return ApiResponse::getUnauthorizedResponse(config('global.error_message.user_not_found'));
        }

        //get device name
        $device_name=config('global.default_device_name');
        if(isset($fields['device_name']) && $fields['device_name']!="")
            $device_name=$fields['device_name'];

        //get token
        $token=$user->createToken($device_name)->plainTextToken; 

        return ApiResponse::getOkResponse(array("user"=>$user,'token'=>$token));
    }

    public function logout($request){
        auth()->user()->tokens()->delete();
        return ApiResponse::getOkResponse("",config('global.message.logout'));
    }

    public function headerValid($request){
        if($request->header('x-api-key')==config('global.header.x-api-key')){
            return true;
        }
        return false;
    }
}

