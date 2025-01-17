<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forum_posts';
    protected $fillable = [
        'name',
        'parent_id',
        'content',
        'subject_id',
        'user_id',
    ];

    protected $casts = [
        'parent_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject() {
        return $this->belongsTo(ForumSubject::class, 'subject_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
//    public function reactions()
//    {
//        return $this->hasMany(ForumReactionPost::class);
//    }
    public function replies()

    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }



    public function latestPost()
    {
        return $this->hasOne(ForumPost::class)->latestOfMany();
    }
    public function latestReply() {
        return $this->hasOne(ForumPost::class, 'parent_id')->latestOfMany();
    }
    public function forumReactionPosts()
    {
        return $this->hasMany(ForumReactionPost::class, 'post_id');
    }
}
