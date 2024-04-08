<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $table = 'ressource';

    protected $fillable = [
        'title',
        'description',
        'link',
        'file_path',
        'file_crypt'
    ];

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'reference_ressource');
    }
}
