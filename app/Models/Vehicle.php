<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'year',
    ];
}
