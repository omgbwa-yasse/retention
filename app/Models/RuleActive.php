<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleActive extends Model
{
    use HasFactory;
    protected $table = 'rule_active';

    protected $fillable = [
        'description'
    ];
}
