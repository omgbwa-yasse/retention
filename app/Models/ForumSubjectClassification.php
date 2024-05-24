<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumSubjectClassification extends Model
{
    use HasFactory;

    protected $table = 'forum_subject_classification';

    protected $fillable = [
        'classification_id',
        'subject_id',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function classes()
    {
        return $this->belongsTo(Classification::class);
    }

    public function subjects()
    {
        return $this->belongsTo(ForumSubject::class);
    }
}

