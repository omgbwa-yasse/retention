<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceFile extends Model
{
    protected $table = 'reference_file';
    protected $fillable = ['title', 'file_path', 'file_crypt', 'reference_id'];

    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }
}
