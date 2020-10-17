<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $fillable = [
        'date_attendance',
        'id_pet',
        'description',
        'status'
    ];
}
