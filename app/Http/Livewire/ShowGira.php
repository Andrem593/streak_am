<?php

namespace App\Http\Livewire;

use App\Models\Etapa;
use App\Models\EtapaHasCliente;
use App\Models\Gira;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowGira extends Component
{
    public $id_gira, $clientes, $collapse = false , $primeraEtapa;

    protected $listeners = ['RenderizarTabla' => 'renderizarTabla'];

    public function mount($id_gira)
    {
        $this->id_gira = $id_gira;
    }

    public function render()
    {
        $gira = Gira::find($this->id_gira);
        $etapas = DB::table('etapa_has_clientes')->rightjoin('etapas', 'etapas.id', '=', 'etapa_has_clientes.id_etapa')
        ->where('etapas.id_gira', $this->id_gira)
        ->select('etapas.*', DB::raw('count(etapa_has_clientes.id_etapa) as total'))
        ->groupBy('etapas.id')
        ->get();
        $clientes_x_etapa = EtapaHasCliente::join('aw_clientes','aw_clientes.id_cliente','=','etapa_has_clientes.id_cliente')
            ->join('etapas','etapas.id','=','etapa_has_clientes.id_etapa')
            ->join('giras','giras.id','=','etapas.id_gira')->select('aw_clientes.*','etapas.id AS id_etapa')->where('giras.id',$this->id_gira)->get();
        $i = 1;
        return view('livewire.show-gira', compact('gira', 'etapas','clientes_x_etapa','i'))->layout('components.plantilla');
    }
    public function renderizarTabla($collapse)
    {
        $this->collapse = $collapse;
        $etapa = Etapa::where('id_gira', $this->id_gira)->first();
        $this->primeraEtapa = $etapa->id;
        $this->render();
    }
}
