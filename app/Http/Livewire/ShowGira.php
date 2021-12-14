<?php

namespace App\Http\Livewire;

use App\Models\Etapa;
use App\Models\Gira;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowGira extends Component
{
    public $id_gira, $clientes;

    public function mount($id_gira)
    {
        $this->id_gira = $id_gira;
        $this->clientes = 'SIN CLIENTES';
    }

    public function render()
    {
        $gira = Gira::find($this->id_gira);
        $etapas = Etapa::where('id_gira', $this->id_gira)->get();
        //$clientes = DB::table('aw_clientes')->get();
        return view('livewire.show-gira', compact('gira', 'etapas'))->layout('components.plantilla');
    }

    public function listar()
    {
        // $this->clientes = DB::table('aw_clientes')->get();
        $this->clientes = 'UN CLIENTE';
    }
}
