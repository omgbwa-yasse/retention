<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectActivity extends Model
{
    use HasFactory;

    protected $table = 'forum_subject_activity';

    protected $fillable = [
        'activity_id',
        'subject_id',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function classes()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function subjects()
    {
        return $this->belongsTo(ForumSubject::class, 'subject_id');
    }
}

