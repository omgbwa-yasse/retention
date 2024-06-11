<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypologyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'user_id',
    ];
    public function parent()
    {
        return $this->belongsTo(TypologyCategory::class, 'parent_id');
    }

}
