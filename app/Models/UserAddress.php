<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'email1',
        'email2',
        'phone1',
        'phone2',
        'country',
        'town',
        'address'
    ];
}
