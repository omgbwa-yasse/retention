<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleActivity extends Model
{
    use HasFactory;

    protected $table = 'rule_activity';

    public $timestamps = false;

    protected $fillable = [
        'activity_id',
        'rule_id'
    ];
}
