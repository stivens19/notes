<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = ['nombre', 'apellido', 'dni', 'direccion'];
    public function notas()
    {
        return $this->hasMany(Nota::class, 'estudiante_id');
    }
    public function cursos()
    {
        return $this->belongsToMany(Course::class, 'estudiante_course', 'estudiante_id', 'course_id');
    }
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
