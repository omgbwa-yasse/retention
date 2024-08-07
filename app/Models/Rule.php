<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

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

    public function countries()
    {
        return $this->belongsTo(country::class, 'country_id');
    }


    public function articles()
    {
        return $this->belongsTo(Articles::class, 'rule_article', 'rule_id');
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


