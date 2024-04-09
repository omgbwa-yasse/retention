<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(ReferenceCategory::class);
    }

    public function files()
    {
        return $this->hasMany(ReferenceFile::class);
    }

    public function links()
    {
        return $this->hasMany(ReferenceLink::class);
    }
}
