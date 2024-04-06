<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dul extends Model
{
    use HasFactory;
    protected $table = 'dul';

    protected $fillable = [
        'duration',
        'description',
        'trigger_id',
        'sort_id'
    ];
}
