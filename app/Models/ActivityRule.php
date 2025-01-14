<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class ActivityRule extends Model
{
    use HasFactory;

    protected $table = 'rule_activity';

    protected $fillable = [
        'activity_id',
        'rule_id',
    ];

    public $timestamps = false;

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
