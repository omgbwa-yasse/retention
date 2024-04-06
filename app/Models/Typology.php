<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;
    protected $table = 'typology';

    protected $fillable = [
        'title',
        'description',
        'typology_category_id'
    ];
}
