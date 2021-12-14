<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaHasCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cliente',
        'id_etapa',
        'id_usuario'
    ];
}
