<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $fillable = [
        'nombre',
        'color',
        'id_gira',
        'orden',
    ];
}
