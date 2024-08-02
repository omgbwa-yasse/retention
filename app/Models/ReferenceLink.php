<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceLink extends Model
{
    protected $fillable = ['user_id','name', 'link', 'reference_id'];

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}
