<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Etapa;
use App\Models\EtapaHasCliente;
use App\Models\Gira;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Historial extends Component
{
    public $comentarios, $comentario,$id_etapa,$id_cliente,$id_gira, $etapa_actual , $etapa_has_cliente;
    public $select, $errorComentario;

    public function mount($id_cliente,$id_etapa,$id_gira)
    {
        $this->id_cliente = $id_cliente;
        $this->id_etapa = $id_etapa;
        $this->id_gira = $id_gira;
        $etapa_actual =  Etapa::find($this->id_etapa);
        $this->etapa_actual = $etapa_actual->id;
        $this->etapa_has_cliente = EtapaHasCliente::where('id_cliente', $id_cliente)->where('id_etapa',$id_etapa)->first();  
        $this->etapa_has_cliente = $this->etapa_has_cliente->id;
    }
    public function render()
    {
        $cliente = DB::table('aw_clientes')->where('id_cliente',$this->id_cliente)->first();
        $gira = Gira::find($this->id_gira);
        $etapas_gira = Etapa::where('id_gira',$this->id_gira)->get();        
        $comment = Comentario::where('id_cliente',$this->id_cliente)->join('aw_users','aw_users.id_usuario','=','comentarios.id_usuario')
        ->join('etapas','etapas.id','=','comentarios.id_etapa')
        ->select('comentarios.*','aw_users.nombre_usuario','etapas.nombre as nombre_etapa','etapas.color')        
        ->OrderBy('id','DESC')->get();
        $comentDay = $comment->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        
        $usuario = DB::table('aw_users')->where('id_usuario',session('id_usuario'))->first('nombre_usuario');
        $this->comentarios = $comment;
        return view('livewire.historial',compact('cliente','usuario','gira','etapas_gira','comentDay'))->layout('components.plantilla');
    }
    public function aggComentario()
    {
        if ($this->select != '') {            
            $comentario = $this->comentario;
            Comentario::create([     
                'id_usuario'=>session('id_usuario'),       
                'id_cliente'=>$this->id_cliente,
                'id_etapa'=>$this->id_etapa,
                'tipo'=>'comentario',
                'tipo_gestion'=>$this->select,
                'comentario'=>$comentario,
            ]);
            $this->comentario = '';
            $this->select = '';
            $this->errorComentario = '';
        }else{
            $this->errorComentario = 'Debe llenar todos los campos para continuar';
        }
    }
    public function cambiarEtapa(){      
        EtapaHasCliente::find($this->etapa_has_cliente)->update([
            'id_etapa'=>$this->etapa_actual,
        ]);
        $this->id_etapa = $this->etapa_actual;
        Comentario::create([     
            'id_usuario'=>session('id_usuario'),       
            'id_cliente'=>$this->id_cliente,
            'id_etapa'=>$this->id_etapa,
            'tipo'=>'cambio_etapa',
            'comentario'=>'cambió la etapa a',
        ]);

    }
}
