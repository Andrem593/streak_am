<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'id_cliente',
        'id_etapa',
        'tipo',
        'comentario',
        'tipo_gestion',
    ];
}
