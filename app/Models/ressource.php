<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_link',
        'file_path',
        'file_crypt'
    ];
}
