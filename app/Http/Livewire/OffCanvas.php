<?php

namespace App\Http\Livewire;

use App\Models\Etapa;
use App\Models\EtapaHasCliente;
use EtapaHasClientes;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OffCanvas extends Component
{
    public $open = false, $clientes,$buscar , $id_gira;

    public function render()
    {
        $this->clientes = DB::table('aw_clientes')->leftJoin('etapa_has_clientes', 'aw_clientes.id_cliente', '=', 'etapa_has_clientes.id_cliente')->Where('aw_clientes.nombre','LIKE','%'.$this->buscar.'%')->whereNull('etapa_has_clientes.id_cliente')->select('aw_clientes.*')->get();
        return view('livewire.off-canvas');
    }
    public function addCliente($cliente)
    {
        $etapa = Etapa::where('id_gira',$this->id_gira)->orderBy('orden')->first();
        EtapaHasCliente::create([
            'id_etapa'=>$etapa->id,
            'id_cliente'=>$cliente,
        ]);
        $this->emit('RenderizarTabla',true);
    }
}
