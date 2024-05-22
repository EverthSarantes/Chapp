<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrerasPorEstudiar extends Model
{
    use HasFactory;

    protected $table = 'carreras_por_estudiars';

    protected $fillable = [
        'nombre',
        'nivel_academico',
        'institucion',
        'info_academica_id'
    ];

    public function infoAcademica()
    {
        return $this->belongsTo(InfoAcademica::class);
    }
}
