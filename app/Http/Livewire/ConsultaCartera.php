<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ConsultaCartera extends Component
{
    public $nombre_cliente, $data_cartera, $tipo_documento, $fecha_emision;
    public function render()
    {
        return view('livewire.consulta-cartera');
    }
    public function carteraCliente()
    {
        $cliente = $this->nombre_cliente;
        $this->data_cartera = DB::table('carteras')->where('cliente',$cliente)->orderBy('tipo_documento', 'asc')->get();
        $this->tipo_documento = DB::table('carteras')->distinct()->where('cliente',$cliente)->orderBy('fecha_emision')->get(['tipo_documento']);
        $this->fecha_emision = DB::table('carteras')->distinct()->where('cliente',$cliente)->orderBy('fecha_emision')->get(['fecha_emision']);
    }
}
