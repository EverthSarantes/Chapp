<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoLaboral extends Model
{
    use HasFactory;

    protected $fillable = [
        'situacion_laboral_actual',
        'experiencia_laboral',
        'user_id',
        'categoria_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function profesiones()
    {
        return $this->hasMany(Profesion::class);
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}
