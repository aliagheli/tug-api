<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $hidden = [
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'license_number',
        'phone_number',
    ];

    public function vehicles(): hasMany
    {
        return $this->hasMany(Vehicle::class);
    }

}