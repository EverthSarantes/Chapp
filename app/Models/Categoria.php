<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }

    public function habilidades()
    {
        return $this->hasMany(Habilidad::class);
    }

    public function profesiones()
    {
        return $this->hasMany(Profesion::class);
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
}
