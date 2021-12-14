<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OffCanvas extends Component
{
    public $open = false;

    public function render()
    {
        return view('livewire.off-canvas');
    }
}
