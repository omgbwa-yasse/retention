<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Classification;
use Illuminate\Database\Eloquent\Model;

class ActivityRule extends Model
{
    use HasFactory;

    protected $table = 'rule_classification';

    protected $fillable = [
        'classification_id',
        'rule_id',
    ];

    public $timestamps = false;

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
