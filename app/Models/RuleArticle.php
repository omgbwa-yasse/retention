<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articles;
use App\Models\Rule;

class RuleArticle extends Model
{
    use HasFactory;

    protected $table = 'rule_articles';
    public $timestamps = false;
    protected $fillable = ['rule_id', 'article_id'];

    public function rules()
    {
        return $this->belongsTo(Rule::class, 'rule_id');
    }

    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id');
    }
}


