<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'info_laboral_id',
        'categoria_id'
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
