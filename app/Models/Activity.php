<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activity extends Model
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'rule_activity', 'activity_id', 'rule_id');
    }

    public function domaine(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function typologies(): BelongsToMany
    {
        return $this->belongsToMany(Typology::class, 'activity_typology', 'activity_id', 'typology_id');
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class, 'basket_activity', 'activity_id', 'basket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(ForumSubject::class, 'forum_subject_activity', 'activity_id', 'subject_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getLevel(): int
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
