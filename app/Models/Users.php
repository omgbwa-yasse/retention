<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'name',
        'surname',
        'gender',
        'date_birth',
        'user_login_id',
        'user_address_id'
    ];
}
