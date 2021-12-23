<?php

namespace App\Http\Controllers;

use App\Mail\RecordatorioMailable;
use App\Models\Comentario;
use App\Models\Etapa;
use App\Models\EtapaHasCliente;
use App\Models\Gira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tarea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class webController extends Controller
{
    public function index()
    {
        if (!empty($_GET['idUsuario'])) {
            $user = DB::table('aw_users')
                ->where('id_usuario', $_GET['idUsuario'])
                ->first();
            session(['id_usuario' => $_GET['idUsuario']]);
        } else {
            $user = DB::table('aw_users')
                ->where('id_usuario', session('id_usuario'))
                ->first();
        }
        
        $giras = Gira::leftJoin('aw_users','aw_users.id_usuario','=','giras.id_usuario')->select('giras.*','aw_users.nombre_usuario');
        if($user->tipo_usuario == 'vendedor'){
            $giras->where('aw_users.id_usuario', session('id_usuario'));
        }
        if (!empty($_GET['id_cliente'])) {
            $giras->join('etapas','etapas.id_gira','=','giras.id')->join('etapa_has_clientes','etapa_has_clientes.id_etapa','=','etapas.id')->join('aw_clientes','aw_clientes.id_cliente','=','etapa_has_clientes.id_cliente')->where('aw_clientes.id_cliente', $_GET['id_cliente']);
        }
        $giras = $giras->get();
        $i = 1;        
        return view('giras.index', compact('giras', 'i','user'));
    }
    public function show($id_gira)
    {
        $gira = Gira::find($id_gira);
        $etapas = Etapa::where('id_gira', $id_gira)->get();
        $clientes = DB::table('aw_clientes')->get();
        return view('giras.show', compact('gira', 'etapas', 'clientes'));
    }

    public function create()
    {
        $gira = new Gira();
        $usuarios = DB::table('aw_users')->where('tipo_usuario','vendedor')->get(['id_usuario','nombre_usuario']);
        return view('giras.create', compact('gira','usuarios'));
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
            'id_usuario'=>$request->vendedor,
        ]);
        foreach ($request->etapas as $i =>$val) {
            Etapa::create([
                'nombre' => $val[0],
                'color' => $val[1],
                'orden' => $i,
                'id_gira' => $gira->id,
            ]);
        }
        return 'success';
    }
    public function editarGira(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50|min:5',
            'estado' => 'required',
        ]);
        Gira::where('id',$request->id)->update([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'estado'=>$request->estado,
        ]);
        foreach ($request->etapas as $i => $val) {
            if ($val[2] != '') {
                Etapa::where('id',$val[2])->update([
                    'orden'=>$i
                ]);
            }else{
                Etapa::create([
                    'nombre'=>$val[0],
                    'color'=>$val[1],
                    'orden'=>$i,
                    'id_gira'=>$request->id,
                ]);
            }
        }
        return 'success';
    }
    public function edit($id_gira)
    {
        $gira = Gira::find($id_gira);
        $estados = ['Activa','Inactiva','Cancelada','Completada'];
        $etapas = Etapa::where('id_gira',$id_gira)->orderBy('orden')->get();
        return view('giras.edit', compact('gira','estados','etapas'));
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
            'id_usuario'=>session('id_usuario'),
            'tarea' => $request->tarea,
            'horario' => $request->horario,
            'tipo_gestion'=>$request->tipo_gestion,
        ]);
        return 'success';
    }
    public function buscarNotificaciones()
    {
        $fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->toDateTimeString();
        Tarea::where('horario','<=',$fecha_actual)->where('estado',1)->update([
            'estado'=> 4
        ]);
        // verificar si debe enviar correo
        $enviarEmail = Tarea::where('estado',4)->get();
        foreach ($enviarEmail as $value) {     
            $usuario = DB::table('aw_users')->where('id_usuario',$value->id_usuario)->first();            
            $correo = new RecordatorioMailable($value);
            Mail::to($usuario->usuario)->send($correo);   
            Tarea::where('estado',4)->update([
                'estado'=> 2
            ]);
        }

        $tareas = Tarea::where('estado',2)->where('id_usuario',session('id_usuario'))
        ->get();
        $notifications = [];

        foreach ($tareas as  $tarea) {
            array_push($notifications, [
                'icon' => 'fas fa-fw fa-clock',
                'text' => $tarea->tarea,
                'time' => $tarea->created_at->diffForHumans(),
                'id'   => $tarea->id,
            ]);
        };        
        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = '<i class="mr-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.0964 16.6667C12.0964 18.5077 10.6039 20 8.76297 20C6.922 20 5.42969 18.5077 5.42969 16.6667C5.42969 14.8257 6.922 13.3333 8.76297 13.3333C10.6039 13.3333 12.0964 14.8257 12.0964 16.6667Z" fill="#22215B"/>
            <path d="M14.603 9.93424C11.778 9.5308 9.59641 7.1016 9.59641 4.16673C9.59641 3.33329 9.77463 2.54258 10.0905 1.82496C9.66385 1.72501 9.22058 1.66673 8.76297 1.66673C5.54642 1.66673 2.92969 4.2833 2.92969 7.50001V9.82331C2.92969 11.4725 2.20718 13.0292 0.939636 14.1008C0.61554 14.3774 0.429688 14.7817 0.429688 15.2083C0.429688 16.0126 1.08383 16.6667 1.88797 16.6667H15.638C16.4423 16.6667 17.0964 16.0126 17.0964 15.2083C17.0964 14.7817 16.9106 14.3774 16.5781 14.0933C15.3481 13.0525 14.6347 11.5416 14.603 9.93424Z" fill="#22215B"/>
            <path d="M19.5964 4.16672C19.5964 6.4679 17.7309 8.33328 15.4297 8.33328C13.1285 8.33328 11.263 6.4679 11.263 4.16672C11.263 1.86554 13.1285 0 15.4297 0C17.7309 0 19.5964 1.86554 19.5964 4.16672Z" fill="#4CE364"/>
            </svg></i>';

            $time = "<span class='float-right text-muted text-sm'>
                   {$not['time']}
                 </span>";

            $dropdownHtml .= "<a href='#' id='{$not['id']}' class='notify dropdown-item'>
                            <div class='card__message text-muted text-sm'>
                            {$icon}recordatorio pendiente
                            <p>{$not['text']}{$time}</p>
                        </div>
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
    public function notificaciones(){
        $tareas = Tarea::where('estado',2)->where('id_usuario',session('id_usuario'))->get();
        return view('recordatorios.index' ,compact('tareas'));
    }
    public function marcarLeida($id_notificacion)
    {
        $tarea = Tarea::where('id',$id_notificacion)->update([
            'estado'=>3,
        ]);

        return 'success';
    }
    public function validacionClientesEtapa(Request $request)
    {
        $etapa = EtapaHasCliente::where('id_etapa',$request->id)->get();
        if ($etapa->count() == 0 ) {
            Etapa::where('id',$request->id)->delete();
        }
        return $etapa->count();

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
