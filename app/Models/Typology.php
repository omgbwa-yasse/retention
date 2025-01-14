<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(TypologyCategory::class, 'category_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'typology_id');
    }
}
