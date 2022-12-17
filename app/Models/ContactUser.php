<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUser extends Model
{
    use HasFactory;
     protected $table = 'contact_user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'user_id_contacted',
        'status_contact',
        'is_delete',
        'deleted_at'
    ];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id_contacted');
    }

}
