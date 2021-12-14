<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aw_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario',
        'nombre_usuario',
        'tipo_usuario',
        'atencion_cliente',
        'estado_usuario'
    ];
}
