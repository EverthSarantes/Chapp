<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'info_laboral_id',
        'categoria_id',
    ];

    public function infoLaboral()
    {
        return $this->belongsTo(InfoLaboral::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
