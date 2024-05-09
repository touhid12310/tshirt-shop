<?php

namespace App\Models;

use App\Models\Campaign;
use App\Models\ProductSize;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'type',
        'name',
        'description',
        'slug',
        'code',
        'dpi_min',
        'dpi_good',
        'dpi_render',
        'is_embroidered',
        'is_active',
        'default_front_image',
        'default_back_image',
        'width',
        'height',
        'width_dimension',
        'height_dimension',
        'bound_top_left_x',
        'bound_top_left_y',
        'drawable_width',
        'drawable_height',
        'back_bound_top_left_x',
        'back_bound_top_left_y',
        'back_drawable_width',
        'back_drawable_height',
        'is_back_drawable',
        'bound_bottom_right_y',
        'price',
        'discount',
        'sku',
        'campaign_id',
        'product_id'
    ];

    public function variations() {
        return $this->hasMany(ProductVariation::class);
    }

    public function sizes() {
        return $this->hasMany(ProductSize::class);
    }

    public function mockup() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function campaign() {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
