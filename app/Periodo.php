<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    protected $fillable = ['anio'];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
