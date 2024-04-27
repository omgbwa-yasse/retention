<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleActive extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

    public function countries()
    {
        return $this->belongsTo(country::class);
    }
}
