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
        'country_id',
        'parent_id',
        'user_id'
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
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function typologies()
    {
        return $this->belongsToMany(Typology::class, 'classification_typology', 'activity_id', 'typology_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_classification', 'classification_id', 'basket_id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(ForumSubject::class, 'forum_subject_classification', 'classification_id', 'subject_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function getLevel()
    {
        $level = 0;
        $parent = $this->parent;

        while ($parent) {
            $level++;
            $parent = $parent->parent;
        }

        return $level;
    }

}
