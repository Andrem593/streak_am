<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ConsultaCartera extends Component
{
    public $nombre_cliente, $data_cartera,$tipo_documentos,$documento;
    public function render()
    {
        $this->tipo_documentos = DB::table('carteras')->distinct()->get('tipo_documento');
        return view('livewire.consulta-cartera');
    }
    public function carteraCliente()
    {
        $cliente = $this->nombre_cliente;
        
        if ($this->documento == '') {
            $this->data_cartera = DB::table('carteras')->where('cliente',$cliente)->orderBy('tipo_documento', 'asc')->get();
        } else {            
            $this->data_cartera = DB::table('carteras')->where('cliente',$cliente)->Where('tipo_documento', $this->documento)->orderBy('tipo_documento', 'asc')->get();
        }

    }
}
