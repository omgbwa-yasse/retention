<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    use HasFactory;
    protected $table = 'actives';

    protected $fillable = [
        'duration',
        'description',
        'trigger_id',
        'rule_id',
        'sort_id',
        'country_id',
        'user_id'
    ];

    public function rule()
    {
        return $this->belongsTo(rule::class);
    }
    public function trigger()
    {
        return $this->belongsTo(Trigger::class);
    }
    public function sort()
    {
        return $this->belongsTo(sort::class);
    }

}
