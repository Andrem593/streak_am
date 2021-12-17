<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gira extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'id_usuario'
    ];
}
