<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    //* to * con vehicle
    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle')->withTimestamps();
    }
}
