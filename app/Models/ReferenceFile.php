<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceFile extends Model
{

    protected $fillable = ['name', 'file_path', 'file_crypt', 'reference_id', 'user_id'];

    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }
}
