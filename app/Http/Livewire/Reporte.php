<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reporte extends Component
{
    public function render()
    {
        $usuario = DB::table('aw_users')->where('id_usuario',session('id_usuario'))->first('nombre_usuario');
        return view('livewire.reporte',compact('usuario'))->layout('components.plantilla');
    }

    public function reporte()
    {
        $response = '';
        $comment = Comentario::where('id_usuario',session('id_usuario'))->join('aw_clientes','aw_clientes.id_cliente','=','comentarios.id_cliente')
        ->select('comentarios.*','aw_clientes.*')->get();
        if (count($comment) == 0) {
            $comment = 'no data';
        }
        $response = json_encode($comment);
        return $response;
    }
}
