<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\ChatInteraction;
use App\Models\DetailChatInteraction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

class ChatInteractionController extends BaseController
{

    public function index(Request $request){
        $id = Auth::user()->id;
        $chatinteraction = ChatInteraction::with(['detailchat' => function($query){
                                                $query->orderBy('created_at', 'asc')->first();
                                              }])->where('user_id',$id)->get();
        return $this->sendResponse($chatinteraction, 'chat interaction Showing successfully');        
    }

    public function create(Request $request){
        $input = $request->all();
        $id = Auth::user()->id;
        $validator = Validator::make($input, [
            'user_id_interaction' => 'nullable',
        ]);

         
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $chatinteractionvalidation = ChatInteraction::where('user_id_interaction',$input['user_id_interaction'])->first();
        if($input['user_id_interaction'] != $id && $chatinteractionvalidation === null){
            $chatinteraction = new ChatInteraction;
            $chatinteraction->user_id = $id;
            $chatinteraction->user_id_interaction= $input['user_id_interaction'];
            $chatinteraction->status_chat_interaction = true;
            $chatinteraction->status_archived_chat = false;
            $chatinteraction->is_delete = false;
            $chatinteraction->save();

            return $this->sendResponse($chatinteraction, 'Chat Interaction create successfully.');

        }else{
            return $this->sendError('Error User Id not valid');
        }
    } 

    public function delete(Request $request,$id){
        $id_user = Auth::user()->id;

        $chatinteraction = ChatInteraction::where('id',$id)->first();
        $chatinteraction->is_delete = true;
        $chatinteraction->deleted_at = Carbon::now();
        $chatinteraction->save();

        $detailchatinteraction = DetailChatInteraction::where('chat_interaction_id',$id)->get();
        $detailchatinteraction->is_delete = true;
        $detailchatinteraction->deleted_at = Carbon::now();
        $detailchatinteraction->save();


        return $this->sendResponse($chatinteraction, 'ChatInteraction User Showing successfully');
    }
}
