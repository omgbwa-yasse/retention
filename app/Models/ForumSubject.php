<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(ForumPost::class, 'subject_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'forum_subject_classification', 'subject_id', 'classification_id');
    }

    public function latestPost(): HasOne
    {
        return $this->hasOne(ForumPost::class, 'subject_id')->latest();
    }
}
