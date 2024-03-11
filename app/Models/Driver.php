<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'CF',
        'vehicle_id',
        'phone',
        'b-day',
        'name',
        'surname',
        'created_at',
        'updated_at'
    ];

    //1 to * con veicoli
    //un autista può avere un solo veicolo
    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }

    //* to * con licence
    public function licences()
    {
        return $this->belongsToMany('App\Models\Licence')->withTimestamps();
    }


}
