<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumReactionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
    ];

    public function reactionPosts()
    {
        return $this->hasMany(ForumReactionPost::class);
    }
}
