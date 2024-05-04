<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basketType extends Model
{
    use HasFactory;

    protected $table = 'basket_types';
    protected $fillable = [
        'name'
    ];

}
