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
        'country_id',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(ReferenceCategory::class, 'category_id');
    }

    public function files()
    {
        return $this->hasMany(ReferenceFile::class);
    }

    public function links()
    {
        return $this->hasMany(ReferenceLink::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function articles()
    {
        return $this->hasMany(ReferenceArticle::class, 'reference_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_reference', 'reference_id', 'basket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
