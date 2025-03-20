<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Vehicle extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $hidden = [
        'driver_id',
        'updated_at',
    ];
    protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'year',
        'driver_id',
    ];

    public function driver(): belongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
