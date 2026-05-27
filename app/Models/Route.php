<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'country',
        'route_name',
        'price',
        'active',
    ];
}