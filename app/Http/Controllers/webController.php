<?php

namespace App\Http\Controllers;

use App\Models\Gira;
use Illuminate\Http\Request;

class webController extends Controller
{
    public function index()
    {
        return view('giras.index');
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

        dd($request);
    }    
}
