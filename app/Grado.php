<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    protected $fillable = ['slug'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
