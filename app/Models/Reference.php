<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReferenceCategory;

class Reference extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
    ];

    protected $table = 'reference';

    public function category()
    {
        return $this->belongsTo(ReferenceCategory::class);
    }

    public function ressources()
    {
        return $this->belongsToMany(Ressource::class, 'reference_ressource');
    }

}
