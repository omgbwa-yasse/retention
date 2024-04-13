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
        return $this->hasMany(Active::class);
    }

    public function duas()
    {
        return $this->hasMany(Dua::class);
    }

    public function duls()
    {
        return $this->hasMany(Dul::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'rule_classification', 'rule_id', 'classification_id');
    }
}


