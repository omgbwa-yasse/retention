<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceLink extends Model
{
    protected $table = 'reference_link';
    protected $fillable = ['title', 'link', 'reference_id'];

    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }
}
