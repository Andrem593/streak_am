<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OffCanvas extends Component
{
    public $open = false, $clientes,$buscar;

    public function render()
    {
        $this->clientes = DB::table('aw_clientes')->Where('nombre','LIKE','%'.$this->buscar.'%')->get();
        return view('livewire.off-canvas');
    }
}
