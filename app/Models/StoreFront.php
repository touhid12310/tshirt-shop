<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFront extends Model
{
    use HasFactory;

    protected $table = 'storefronts';

    protected $guarded = [];

    public $timestamps = false;
}
