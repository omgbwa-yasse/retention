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
        'country_id',
        'rule_id',
        'trigger_id',
        'sort_id',
        'user_id'
        ];


    public function rule()
    {
        return $this->belongsTo(Rule::class, 'rule_id');
    }


    public function trigger()
    {
        return $this->belongsTo(Trigger::class, 'trigger_id');
    }


    public function sort()
    {
        return $this->belongsTo(Sort::class, 'sort_id');
    }

    public function countries()
    {
        return $this->belongsTo(country::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Articles::class, 'dul_articles');
    }


}
