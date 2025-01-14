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
        'country_id',
        'user_id',
        'status_id',
        'validated_at',
        'validated_by'
    ];

    public function duls()
    {
        return $this->hasMany(Dul::class);
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Articles::class, 'dul_articles', 'dul_id', 'article_id');
    }

    public function activitys()
    {
        return $this->belongsToMany(Activity::class, 'rule_activity', 'rule_id', 'activity_id');
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
