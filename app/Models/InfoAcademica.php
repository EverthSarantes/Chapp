<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoAcademica extends Model
{
    use HasFactory;

    protected $table = 'info_academicas';

    protected $fillable = [
        'nivel_academico',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carrerasEstudiadas()
    {
        return $this->hasMany(CarrerasEstudiadas::class, 'info_academica_id');
    }

    public function carrerasPorEstudiar()
    {
        return $this->hasMany(CarrerasPorEstudiar::class);
    }
}
