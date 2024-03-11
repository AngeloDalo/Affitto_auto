<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Licence extends Model
{
    protected $fillable = [
        'code',
        'cayegory',
        'created_at',
        'updated_at'
    ];

    //* to * con driver
    public function drivers()
    {
        return $this->belongsToMany('App\Models\Drivers')->withTimestamps();
    }
}
