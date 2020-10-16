<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $fillable = [
        'data',
        'id_pet',
        'description',
        'status'
    ];
}
