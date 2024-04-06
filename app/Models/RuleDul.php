<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleDul extends Model
{
    use HasFactory;
    protected $table = 'rule_dul';

    protected $fillable = [
        'datetime',
        'description'
    ];
}
