<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sexo',
        'telefono',
        'discapacidad',
        'direccion',
        'fecha_nacimiento',
        'expectativa_salarial',
        'user_id',
    ];

    // protected $casts = [
    //     'fecha_nacimiento' => 'date:Y-m-d',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function infoAcademica()
    {
        return $this->hasOne(InfoAcademica::class);
    }
}
