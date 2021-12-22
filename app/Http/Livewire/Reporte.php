<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Gira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reporte extends Component
{
    public function render()
    {
        $gira = Gira::all();        
        $usuario = DB::table('aw_users')->where('id_usuario',session('id_usuario'))->first('nombre_usuario');
        $usuarios = DB::table('aw_users')->where('tipo_usuario','vendedor')->get();
        return view('livewire.reporte',compact('usuario','usuarios','gira'))->layout('components.plantilla');
    }

    public function reporte(Request $request)
    {

        $response = '';
        $comment = Comentario::join('aw_clientes','aw_clientes.id_cliente','=','comentarios.id_cliente')
        ->select('comentarios.*','aw_clientes.*')->where('tipo','<>','cambio_etapa');
        if(!empty($request->id_usuario)){
            $comment->where('comentarios.id_usuario',$request->id_usuario);
        }
        if(!empty($request->id_gira)){
            $comment->join('etapas','etapas.id','=','comentarios.id_etapa')->join('giras','giras.id','=','etapas.id_gira')->where('giras.id',$request->id_gira);
        }
        if(!empty($request->id_cliente)){
            $comment->where('aw_clientes.id_cliente',$request->id_cliente);
        }
        if(!empty($request->fecha_desde) && !empty($request->fecha_hasta)){
            $comment->whereBetween('comentarios.created_at', [$request->fecha_desde, $request->fecha_hasta]);
        }
        $comment = $comment->get();
        if (count($comment) == 0) {
            $comment = [];
        }
        $response = json_encode($comment);
        return $response;
    }
}
