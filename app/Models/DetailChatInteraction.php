<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailChatInteraction extends Model
{
    use HasFactory;
     protected $table = 'detail_chat_interaction';

    protected $primaryKey = 'id';
}
