<?php

namespace App\Models;

use App\Models\ProductSize;
use App\Models\ProductShowcase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_name',
        'color_hex',
        'front_image_path',
        'back_image_path',
    ];

    public function sizes() {
        return $this->hasMany(ProductSize::class);
    }

    public function mockups() {
        return $this->hasMany(ProductShowcase::class);
    }
}
