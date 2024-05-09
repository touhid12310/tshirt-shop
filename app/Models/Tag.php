<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    // timestamp false
    public $timestamps = false;
}
