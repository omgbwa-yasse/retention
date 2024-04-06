<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communicability extends Model
{
    use HasFactory;

    protected $table = 'communicability';

    protected $fillable = [
        'code',
        'title',
        'description'
    ];
}
