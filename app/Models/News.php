<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;

    protected $table = 'news';


    // Définir les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'name',
        'description',
        'published',
        'user_id',
    ];

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
