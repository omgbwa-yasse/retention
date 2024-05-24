<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\ForumPost;

class ForumSubject extends Model
{
    use HasFactory;
    protected $table = 'forum_subjects';
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function amswers(): HasMany
    {
        return $this->hasMany(ForumPost::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classification::class, 'forum_subject_classification', 'subject_id', 'classification_id');
    }
}
