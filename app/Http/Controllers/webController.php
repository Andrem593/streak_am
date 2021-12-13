<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Gira;
use Illuminate\Http\Request;
use App\Events\RealTimeMessage;
use Illuminate\Support\Facades\DB;
use App\Models\Aw_user;
use App\Models\Tarea;
use Carbon\Carbon;

class webController extends Controller
{
    public function index()
    {
        $giras = Gira::all();
        $i = 1;
        return view('giras.index', compact('giras', 'i'));
        // return view('welcome');
    }
    public function show($id_gira)
    {
        $gira = Gira::find($id_gira);
        $etapas = Etapa::where('id_gira', $id_gira)->get();
        $clientes = DB::table('aw_clientes')->all();
        return view('giras.show', compact('gira', 'etapas', 'clientes'));
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
            'nombre' => trim(strtoupper($request->nombre)),
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);
        foreach ($request->etapas as $val) {
            Etapa::create([
                'nombre' => $val[0],
                'color' => $val[1],
                'id_gira' => $gira->id,
            ]);
        }
        return 'success';
    }

    public function autocompletar(Request $request)
    {

        $data = $request->all();

        $term = $data['term'];

        $clientes = DB::table('aw_clientes')
            ->where('ruc', 'LIKE', '%' . $term . '%')
            ->orwhere('nombre', 'LIKE', '%' . $term . '%')
            ->limit(10)
            ->get();

        $response = array();

        foreach ($clientes as $cliente) {
            $response[] = array("value" => $cliente->nombre, "ruc" => $cliente->ruc, "id" => $cliente->id_cliente);
        }

        if (count($response) == 0) {
            $response[] = array("value" => "");
        }

        return response()->json($response);
    }
    public function crearTarea(Request $request)
    {
        Tarea::create([
            'tarea' => $request->tarea,
            'horario' => $request->horario
        ]);
        return 'success';
    }
    public function buscarNotificaciones()
    {
        $tareas = Tarea::where('estado',1)->get();
        $notifications = [];

        foreach ($tareas as  $tarea) {
            array_push($notifications, [
                'icon' => 'fas fa-fw fa-clock',
                'text' => $tarea->tarea,
                'time' => $tarea->created_at->diffForHumans(),
            ]);
        };

        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                   {$not['time']}
                 </span>";

            $dropdownHtml .= "<a href='#' class='dropdown-item'>
                            {$icon}{$not['text']}{$time}
                          </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'warning',
            'dropdown'    => $dropdownHtml,
        ];
    }
}
