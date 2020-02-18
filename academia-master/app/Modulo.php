<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable=['nombre', 'horas'];

    //Metodos para la relacion n:m con Alumnos
    public function alumnos(){
       return $this->belongsToMany('App\Alumno')->withPivot('nota')->withTimestamps();
    }
}
