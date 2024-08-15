<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'type_id'
    ];

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'basket_rule', 'basket_id', 'rule_id');
    }

    public function classes()
    {
        return $this->belongsToMany(Classification::class, 'basket_classification', 'basket_id', 'classification_id');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'basket_reference', 'basket_id', 'reference_id', 'user_id');
    }
    public function type()
    {
        return $this->belongsTo(basketType::class,'type_id');
    }

}
