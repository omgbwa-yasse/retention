<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'reference_id',
        'user_id',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
