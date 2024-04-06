<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dua extends Model
{
    use HasFactory;

    protected $table = 'dua';

    protected $fillable = [
        'duration',
        'description',
        'trigger_id',
        'sort_id'
    ];
}
