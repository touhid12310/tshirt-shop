<?php

namespace App\Models;

use App\Models\OrderLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'full_name',
        'address_line_1',
        'address_line_2',
        'country',
        'city',
        'state',
        'zip',
        'shipping_fees',
        'tax',
        'vat',
        'discount',
        'promo_code',
        'total',
    ];

    public function orderLines() {
        return $this->hasMany(OrderLine::class);
    }
}
