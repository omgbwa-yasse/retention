<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReactionType extends Model
{
    use HasFactory;

    protected $table = 'forum_reaction_type';

    protected $fillable = [
        'title',
        'url'
    ];
}
