<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleDua extends Model
{
    use HasFactory;
    protected $table = 'rule_dua';

    protected $fillable = [
        'description'
    ];
}
