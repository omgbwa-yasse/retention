<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forum_posts';

    protected $fillable = [
        'name',
        'content',
        'subject_id',
        'parent_id',
        'user_id'
    ];

    public function subject()
    {
        return $this->belongsTo(ForumSubject::class, 'subject_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(ForumPost::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(ForumPost::class, 'parent_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(ForumReactionPost::class, 'post_id', 'id');
    }
    public function replies()
    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }

}
