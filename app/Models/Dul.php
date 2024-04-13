<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dul extends Model
{
    use HasFactory;

    protected $fillable = [
        'duration',
        'description',
        'rule_id',
        'trigger_id',
        'sort_id'
        ];


    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }


    public function trigger()
    {
        return $this->belongsTo(Trigger::class);
    }


    public function sort()
    {
        return $this->belongsTo(Sort::class);
    }
}
