<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\ContactUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

class ContactController extends BaseController
{
    public function index(Request $request){
        $id = Auth::user()->id;
        $contactuser = ContactUser::with('user')->where('user_id',$id)->where('is_delete','=',0)->get();
        return $this->sendResponse($contactuser, 'Contact User Showing successfully');
    }

    public function create(Request $request){
        $input = $request->all();
        $id = Auth::user()->id;
        $validator = Validator::make($input, [
            'user_id_contacted' => 'nullable',
        ]);

         
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if($input['user_id_contacted'] != $id){
            $contactuser = new ContactUser;
            $contactuser->user_id = $id;
            $contactuser->user_id_contacted = $input['user_id_contacted'];
            $contactuser->status_contact = true;
            $contactuser->is_delete = false;
            $contactuser->save();

            return $this->sendResponse($contactuser, 'Contact User create successfully.');

        }else{
            return $this->sendError('Error User Id not valid');
        }
        
    }

    public function delete(Request $request,$id){
        $id_user = Auth::user()->id;
        $user = ContactUser::with('user')->where('id',$id)->where('user_id',$id_user)->first();
        $user->is_delete = true;
        $user->deleted_at = Carbon::now();
        $user->save();

        return $this->sendResponse($user, 'Contact User Showing successfully');
    }


}
