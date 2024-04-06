<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $table = 'reference';

    protected $fillable = [
        'title',
        'datetime',
        'link',
        'file_sha1',
        'typology_id'
    ];
}
