<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumAnswer extends Model
{
    use HasFactory;
    protected $table = 'forum_answer';

    protected $fillable = [
        'title',
        'parent_id',
        'subject_id'
    ];
}
