<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatInteraction extends Model
{
    use HasFactory;

    protected $table = 'chat_interactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'user_id_interaction',
        'status_chat_interaction',
        'status_archived_chat',
        'is_delete',
        'deleted_at'
    ];
    public function detailchat()
    {
        return $this->hasOne(DetailChatInteraction::class, 'chat_interaction_id');
    }
}
