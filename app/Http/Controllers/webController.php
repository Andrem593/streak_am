<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Gira;
use Illuminate\Http\Request;

class webController extends Controller
{
    public function index()
    {
        $giras = Gira::all();  
        $i = 1; 
        return view('giras.index',compact('giras','i'));
    }
    public function show()
    {
        return view('giras.show');
    }
    public function create()
    {
        $gira = new Gira();
        return view('giras.create', compact('gira'));
    }
    public function createGira(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50|min:5',
            'estado' => 'required',
        ]);
        $gira = Gira::create([
             'nombre'=>trim(strtoupper($request->nombre)),
             'descripcion'=>$request->descripcion,
             'estado'=>$request->estado,
        ]);
        foreach ($request->etapas as $val) {
            Etapa::create([
                'nombre'=>$val[0],
                'color'=>$val[1],
                'id_gira'=>$gira->id,
            ]);            
        }
        return 'success';
    }    
}
