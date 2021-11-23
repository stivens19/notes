<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['nombre'];
    public function notas()
    {
        return $this->hasMany(Nota::class, 'course_id');
    }
    protected $hidden = [
        'pivot','created_at','updated_at',
    ];
}
