<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleClassification extends Model
{
    use HasFactory;

    protected $table = 'rule_classification';

    public $timestamps = false;

    protected $fillable = [
        'classification_id',
        'rule_id'
    ];
}
