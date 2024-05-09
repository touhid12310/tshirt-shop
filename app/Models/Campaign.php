<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'konva_object',
        'artworks',
        'text_works',
        'title',
        'description',
        'slug',
        'tags'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function single_products()
    {
        return $this->hasOne(Product::class)->where('type', 'PRODUCT');;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
