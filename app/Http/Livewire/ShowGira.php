<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Etapa;
use App\Models\EtapaHasCliente;
use App\Models\Gira;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowGira extends Component
{
    public $id_gira, $clientes, $collapse = false, $primeraEtapa, $selectedClientes = [], $selectAll = false, $options = false, $selectedEtapa;

    protected $listeners = ['RenderizarTabla' => 'renderizarTabla'];

    public function mount($id_gira)
    {
        $this->id_gira = $id_gira;
        $this->selectedClientes = collect();
    }

    public function render()
    {
        $this->options = count($this->selectedClientes) > 0;
        $gira = Gira::find($this->id_gira);
        $etapas = DB::table('etapa_has_clientes')->rightjoin('etapas', 'etapas.id', '=', 'etapa_has_clientes.id_etapa')
            ->where('etapas.id_gira', $this->id_gira)            
            ->select('etapas.*', DB::raw('count(etapa_has_clientes.id_etapa) as total'))
            ->groupBy('etapas.id')
            ->orderBy('orden')
            ->get();
        $clientes_x_etapa = EtapaHasCliente::join('aw_clientes', 'aw_clientes.id_cliente', '=', 'etapa_has_clientes.id_cliente')
            ->join('etapas', 'etapas.id', '=', 'etapa_has_clientes.id_etapa')
            ->join('giras', 'giras.id', '=', 'etapas.id_gira')
            ->leftjoin('cat_ciudad', 'cat_ciudad.descripcion', '=', 'aw_clientes.ciudad')
            ->leftjoin('cat_provincia', 'cat_provincia.id_provincia', '=', 'cat_ciudad.id_provincia')
            ->leftjoin('aw_users', 'aw_users.id_usuario', '=', 'etapa_has_clientes.id_usuario')
            ->select('aw_clientes.*', 'etapas.id AS id_etapa', 'cat_provincia.descripcion AS nombre_provincia', 'aw_users.nombre_usuario')->where('giras.id', $this->id_gira)->get();
        $clientes_x_etapa_D = EtapaHasCliente::join('aw_clientes', 'aw_clientes.id_cliente', '=', 'etapa_has_clientes.id_cliente')
            ->join('etapas', 'etapas.id', '=', 'etapa_has_clientes.id_etapa')            
            ->join('giras', 'giras.id', '=', 'etapas.id_gira')->select('etapas.id AS id_etapa')->where('giras.id', $this->id_gira)->distinct('etapas.id')->get();
        $i = 1;
        $usuario = DB::table('aw_users')->where('id_usuario', session('id_usuario'))->first('tipo_usuario');
        return view('livewire.show-gira', compact('gira', 'etapas', 'clientes_x_etapa', 'clientes_x_etapa_D', 'i', 'usuario'))->layout('components.plantilla');
    }
    public function renderizarTabla($collapse)
    {
        $this->collapse = $collapse;
        $etapa = Etapa::where('id_gira', $this->id_gira)->first();
        $this->primeraEtapa = $etapa->id;
        $this->render();
    }

    public function clearSelected()
    {
        $this->selectedClientes = [];
    }

    public function changeEtapa()
    {

        if (!empty($this->selectedEtapa)) {
            foreach ($this->selectedClientes as $value) {


                $val = EtapaHasCliente::where('id_cliente', $value)->first();

                if ($val->id_etapa != $this->selectedEtapa) {
                    EtapaHasCliente::where('id', $val->id)->update([
                        'id_etapa' => $this->selectedEtapa,
                    ]);
                    Comentario::create([
                        'id_usuario' => session('id_usuario'),
                        'id_cliente' => $value,
                        'id_etapa' => $this->selectedEtapa,
                        'tipo' => 'cambio_etapa',
                        'comentario' => 'cambi?? la etapa a',
                    ]);
                }
            }
            $this->selectedClientes = [];
            $this->render();
        }
    }
    public function deleteClientes()
    {

        foreach ($this->selectedClientes as $value) {
            $val = EtapaHasCliente::where('id_cliente', $value)->delete();
        }
        $this->selectedClientes = [];
        $this->render();
    }
}
