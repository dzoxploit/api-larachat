<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\UserBasicInfo;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserBasicInfoController extends BaseController
{
    public function index(Request $request){
        $id = Auth::user()->id;

        $user = UserBasicInfo::with('user')->where('user_id',$id)->get();

        return $this->sendResponse($user, 'User Basic Info Showing successfully');
    }

    public function edit(Request $request){
        $input = $request->all();
        $id = Auth::user()->id;

        $validator = Validator::make($input, [
                'status_basic_info' => 'nullable',
                'description' => 'nullable',
        ]);

         
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userbasicinfo = UserBasicInfo::where('user_id','=',$id)->firstOrFail();
        $userbasicinfo->status_basic_info = $input['status_basic_info'];
        $userbasicinfo->description = $input['description'];
        $userbasicinfo->save();

         return $this->sendResponse($userbasicinfo, 'User basic info edite successfully.');
    }
}
