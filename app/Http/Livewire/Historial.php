<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Historial extends Component
{
    public function render()
    {
        return view('livewire.historial')->layout('components.plantilla');
    }
}
