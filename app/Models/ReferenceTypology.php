<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceTypology extends Model
{
    use HasFactory;
    protected $table = 'reference_typology';

    protected $fillable = [
        'title'
    ];
}
