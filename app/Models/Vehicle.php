<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    protected $fillable = [
        'color',
        'fuel',
        'max_weight',
        'type',
        'created_at',
        'updated_at'
    ];

    //1 to * con driver
    //un mezzo può avere più guidatori
    public function drivers()
    {
        return $this->hasMany('App\Models\Driver');
    }

    //* to * con device
    public function devices()
    {
        return $this->belongsToMany('App\Models\Devices')->withTimestamps();
    }
}
