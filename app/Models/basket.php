<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'basket_rule', 'basket_id', 'rule_id');
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'basket_classification', 'basket_id', 'classification_id');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'basket_reference', 'basket_id', 'reference_id');
    }

}
