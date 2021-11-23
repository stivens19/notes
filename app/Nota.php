<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'estudiante_course';
    protected $fillable = ['estudiante_id', 'course_id','periodo_id','grado_id', 'promedio','grado'];
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
    public function gradoo()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
