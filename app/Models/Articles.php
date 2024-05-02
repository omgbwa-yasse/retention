<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'name',
        'description',
        'reference_id',
        'user_id',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id');
    }

}
