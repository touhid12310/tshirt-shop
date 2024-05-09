<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFrontMenu extends Model
{

    use HasFactory;

    protected $table = 'storefronts_menus';

    protected $guarded = [];

    public $timestamps = false;
}
