<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $fillable = [
        'name_pet',
        'id_specie'
    ];

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendances');
    }
}
