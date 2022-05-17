<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $cliente, $edit = false;

    public $id_cliente,$ruc,$nombre,$email,$telefono;
    
    public $provincia,$ciudad,$provincias,$ciudades;

    protected $paginationTheme = 'simple-bootstrap';

    public function render()
    {
        if ($this->provincia != '') {
            $this->provincias = DB::table('cat_provincia')->get();
            $provincia = DB::table('cat_provincia')->where('descripcion',$this->provincia)->get()->toArray();
            $this->ciudades = DB::table('cat_ciudad')->where('id_provincia', $provincia[0]->id_provincia)->get();            
        }
        $clientes = DB::table("aw_clientes")->where('ruc','like',"%".$this->cliente."%")
        ->orWhere('nombre','like',"%".$this->cliente."%")
        ->paginate(20);        
        return view('livewire.clientes',compact('clientes'))->layout('components.plantilla');
    }
    public function edit($id)
    {
        $this->edit ? $this->edit = false : $this->edit = true;
        $cliente = DB::table('aw_clientes')->where('id_cliente','=',$id)->get()->toArray();
        $this->id_cliente = $cliente[0]->id_cliente;
        $this->nombre = $cliente[0]->nombre;
        $this->ruc = $cliente[0]->ruc;
        $this->email = $cliente[0]->email;
        $this->telefono = $cliente[0]->telefono;

        $ciudad = DB::table('cat_ciudad')->where('descripcion','LIKE','%'.$cliente[0]->ciudad.'%')->get()->toArray();
        $this->ciudad = $ciudad[0]->descripcion;
        $provincia = DB::table('cat_provincia')->where('id_provincia','=',$ciudad [0]->id_provincia)->get()->toArray();
        $this->provincia = $provincia[0]->descripcion;
        $this->provincias = DB::table('cat_provincia')->get();
        $this->ciudades = DB::table('cat_ciudad')->where('id_provincia','=',$ciudad [0]->id_provincia)->get();
    }

    public function	save()
    {
        if (!empty($this->nombre) && !empty($this->ruc) && !empty($this->telefono) && !empty($this->ciudad) && !empty($this->email) ) {
            DB::table("aw_clientes")->where('id_cliente',$this->id_cliente)
            ->update([
                'ruc'=>$this->ruc,
                'nombre'=>$this->nombre,
                'email'=>$this->email,
                'telefono'=>$this->telefono,
                'ciudad'=>$this->ciudad,
            ]);
            $this->edit = false;
        } else {
            
        } 
    }
}
