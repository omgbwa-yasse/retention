<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'duration',
        'country_id',
        'trigger_id',
        'sort_id',
        'user_id',
        'status_id',
        'validated_at',
        'validated_by'
    ];



    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function trigger()
    {
        return $this->belongsTo(Trigger::class, 'trigger_id');
    }

    public function sort()
    {
        return $this->belongsTo(Sort::class, 'sort_id');
    }
    public function articles()
    {
        return $this->belongsToMany(Articles::class, 'dul_articles', 'dul_id', 'article_id');
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'rule_classification', 'rule_id', 'classification_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_rule', 'rule_id', 'basket_id');

    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
