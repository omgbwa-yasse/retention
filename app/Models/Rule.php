<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'state_id'
    ];

    public function actives()
    {
        return $this->hasMany(RuleActive::class);
    }

    public function duas()
    {
        return $this->hasMany(RuleDua::class);
    }

    public function duls()
    {
        return $this->hasMany(RuleDul::class);
    }

    public function classifications()
    {
        return $this->hasMany(RuleClassification::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}


