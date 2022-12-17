<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBasicInfo extends Model
{
    use HasFactory;

    protected $table = 'user_basic_info';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'status_basic_info',
        'description',
        'is_delete',
        'deleted_at'
    ];

     public function User()
    {
        return $this->hasOne(User::class, 'id');
    }
}
