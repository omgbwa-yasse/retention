<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypologyCategory extends Model
{
    use HasFactory;
    protected $table = 'typology_category';

    protected $fillable = [
        'title',
        'description',
        'category_parent_id'
    ];
}
