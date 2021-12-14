<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use Livewire\Component;

class Historial extends Component
{
    public $comentarios, $comentario;
    public function render()
    {
        $comment = Comentario::OrderBy('id','DESC')->get();
        $this->comentarios = $comment;
        return view('livewire.historial')->layout('components.plantilla');
    }
    public function aggComentario()
    {
        $comentario = $this->comentario;
        Comentario::create([
            'tipo'=>'comentario',
            'comentario'=>$comentario,
        ]);
        $this->comentario = '';
    }
}
