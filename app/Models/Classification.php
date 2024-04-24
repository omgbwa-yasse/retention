<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Classification::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Classification::class, 'parent_id');
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'rule_classification', 'classification_id', 'rule_id');
    }

    public function domaine()
    {
        return $this->hasOne(self::class, 'id', 'parent_id')
            ->with('domaine')
            ->whereNull('parent_id');
    }

    public function typologies()
    {
        return $this->belongsToMany(Typology::class, 'classification_typology', 'activity_id', 'typology_id');
    }
}
