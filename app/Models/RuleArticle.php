<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReferenceArticle;
use App\Models\Rule;

class RuleArticle extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $fillable = ['rule_id', 'article_id', 'user_id'];

    public function rules()
    {
        return $this->belongsTo(Rule::class, 'rule_id');
    }

    public function articles()
    {
        return $this->belongsTo(ReferenceArticle ::class, 'article_id');
    }
}


