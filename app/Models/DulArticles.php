<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articles;
use App\Models\Dul;

class DulArticle extends Model
{
    use HasFactory;

    protected $table = 'dul_articles';
    public $timestamps = false;
    protected $fillable = ['dul_id', 'article_id'];

    public function duls()
    {
        return $this->belongsTo(Dul::class, 'dul_id');
    }

    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id');
    }
}


