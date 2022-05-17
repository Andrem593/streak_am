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

        $ultimaCartera = DB::table('carteras')->orderByDesc('id')->limit(1)->get();
        $ultimaCartera = $ultimaCartera[0];

        if ($this->documento == '' && $cliente == '' ) {
            $this->data_cartera = DB::table('carteras')->where('fecha_inicio',$ultimaCartera->fecha_inicio)->get();
        } else if ($cliente != '' && $this->documento == '')  {  
            $this->data_cartera = DB::table('carteras')->where('cliente',$cliente)->where('fecha_inicio',$ultimaCartera->fecha_inicio)->orderBy('tipo_documento', 'asc')->get();          
        }else{
            $this->data_cartera = DB::table('carteras')->where('cliente',$cliente)->where('fecha_inicio',$ultimaCartera->fecha_inicio)->Where('tipo_documento', $this->documento)->orderBy('tipo_documento', 'asc')->get();            
        }

    }
}
