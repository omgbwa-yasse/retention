<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceCategory extends Model
{
    use HasFactory;

    protected $table = 'reference_category';


    public function reference()
    {
        return $this->hasMany(Reference::class);
    }
}
