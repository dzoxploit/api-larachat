<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\UserBasicInfo;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
{
     public function register(Request $request)
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' =>'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
                ]);
 
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
 
                $input = $request->all();
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                $success['token'] =  $user->createToken('appToken')->accessToken;
                $success['name'] =  $user->name;

                $userbasicinfo = new UserBasicInfo;
                $userbasicinfo->user_id = $user->id;
                $userbasicinfo->status_basic_info = 'Available';
                $userbasicinfo->description = 'Akhirnya healing ini menyembuhkan kegalauanku';
                $userbasicinfo->is_delete = false;
                $userbasicinfo->deleted_at = null;
                $userbasicinfo->save();

 
                return $this->sendResponse($success, 'User register successfully.');
            }
 
            /**
            * Login api
            *
            * @return \Illuminate\Http\Response
            */
            public function login(Request $request)
            {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                    $user = Auth::user(); 
                    $success['token'] =  $user->createToken('appToken')->accessToken;; 
                    $success['name'] =  $user->name;
 
                    return $this->sendResponse($success, 'User login successfully.');
                } 
                else{ 
                    return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
                } 
            }
}
