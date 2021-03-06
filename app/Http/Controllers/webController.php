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
use DateTime;
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

        $giras = Gira::leftJoin('aw_users', 'aw_users.id_usuario', '=', 'giras.id_usuario')->select('giras.*', 'aw_users.nombre_usuario');
        if ($user->tipo_usuario == 'vendedor') {
            $giras->where('aw_users.id_usuario', session('id_usuario'));
        }
        if (!empty($_GET['id_cliente'])) {
            $giras->join('etapas', 'etapas.id_gira', '=', 'giras.id')->join('etapa_has_clientes', 'etapa_has_clientes.id_etapa', '=', 'etapas.id')->join('aw_clientes', 'aw_clientes.id_cliente', '=', 'etapa_has_clientes.id_cliente')->where('aw_clientes.id_cliente', $_GET['id_cliente']);
        }
        $giras = $giras->get();
        $i = 1;
        $ultimaCartera = DB::table('carteras')->orderByDesc('id')->limit(1)->get();
        $ultimaCartera = $ultimaCartera[0];

        $presupuesto = DB::table('carteras')->select(DB::raw('sum(carteras.saldo) as saldo'))->join('giras','giras.id','=','carteras.id_gira')
        ->join('aw_users', 'aw_users.id_usuario','=','giras.id_usuario')
        ->where('giras.id_usuario',$user->id_usuario)
        ->where('carteras.fecha_inicio', $ultimaCartera->fecha_inicio)
        ->groupBy('aw_users.id_usuario')->get();
                
        $total_recaudado = Comentario::where('id_usuario',$user->id_usuario)
        ->whereBetween('created_at',[$ultimaCartera->fecha_inicio,$ultimaCartera->fecha_fin])
        ->selectRaw('SUM(valor_recaudado) as total_recaudado')->first();

        $total_comentarios = Comentario::where('id_usuario',$user->id_usuario)->selectRaw('COUNT(id) as total_comentarios')->first();
        $progreso = count($presupuesto) > 0 ? number_format ((($total_recaudado->total_recaudado/$presupuesto[0]->saldo)*100),2)."%" : 'SIN PRESUPUESTO';
        return view('giras.index', compact('giras', 'i', 'user','total_recaudado','progreso','total_comentarios','presupuesto'));
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
        $usuarios = DB::table('aw_users')->where('tipo_usuario', 'vendedor')->get(['id_usuario', 'nombre_usuario']);
        return view('giras.create', compact('gira', 'usuarios'));
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
            'id_usuario' => $request->vendedor,
        ]);
        foreach ($request->etapas as $i => $val) {
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
        Gira::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);
        foreach ($request->etapas as $i => $val) {
            if ($val[2] != '') {
                Etapa::where('id', $val[2])->update([
                    'orden' => $i
                ]);
            } else {
                Etapa::create([
                    'nombre' => $val[0],
                    'color' => $val[1],
                    'orden' => $i,
                    'id_gira' => $request->id,
                ]);
            }
        }
        return 'success';
    }
    public function edit($id_gira)
    {
        $gira = Gira::find($id_gira);
        $estados = ['Activa', 'Inactiva', 'Cancelada', 'Completada'];
        $etapas = Etapa::where('id_gira', $id_gira)->orderBy('orden')->get();
        return view('giras.edit', compact('gira', 'estados', 'etapas'));
    }

    public function autocompletar(Request $request)
    {
        $data = $request->all();

        $term = $data['term'];
        $response = array();

        if (!empty($term)) {
            $clientes = DB::table('aw_clientes')
                ->where('aw_clientes.ruc', 'LIKE', '%' . $term . '%')
                ->orwhere('aw_clientes.nombre', 'LIKE', '%' . $term . '%')
                ->limit(10);

            $user = DB::table('aw_users')
                ->where('id_usuario', session('id_usuario'))
                ->first();

            if (!empty($data['only'])) {
                $only = $data['only'];
                if ($only == 'etapaCliente') {
                    $clientes->join('etapa_has_clientes', 'etapa_has_clientes.id_cliente', '=', 'aw_clientes.id_cliente')->join('etapas', 'etapas.id', '=', 'etapa_has_clientes.id_etapa')->join('giras', 'giras.id', '=', 'etapas.id_gira')->select('aw_clientes.*', 'etapas.id as id_etapa', 'giras.id as id_gira');
                    if ($user->tipo_usuario == 'vendedor') {
                        $clientes->where('giras.id_usuario', $user->id_usuario);
                    }
                }
            }

            $clientes = $clientes->get();
            

            if (!empty($data['only'])) {
                foreach ($clientes as $cliente) {
                    $response[] = array("value" => $cliente->nombre, "ruc" => $cliente->ruc, "id" => $cliente->id_cliente, "id_etapa" => $cliente->id_etapa, "id_gira" => $cliente->id_gira);
                }
            } else {
                foreach ($clientes as $cliente) {
                    $response[] = array("value" => $cliente->nombre, "ruc" => $cliente->ruc, "id" => $cliente->id_cliente);
                }
            }

            if (count($response) == 0) {
                $response[] = array("value" => "");
            }
        }else{
            $response[] = array("value" => "");
        }

        return response()->json($response);
    }
    public function autocompletar_cartera(Request $request)
    {
        $data = $request->all();

        $term = $data['term'];
        $response = array();

        if (!empty($term)) {
            $clientes = DB::table('carteras')
                ->distinct()
                ->where('cliente', 'LIKE', '%' . $term . '%')
                ->select('codigo','cliente')            
                ->limit(10);


            $clientes = $clientes->get();
            
            
            foreach ($clientes as $cliente) {
                $response[] = array("value" => $cliente->cliente,"id" => $cliente->codigo);
            }
            

            if (count($response) == 0) {
                $response[] = array("value" => "");
            }
        }else{
            $response[] = array("value" => "");
        }

        return response()->json($response);
    }
    public function crearTarea(Request $request)
    {
        Tarea::create([
            'id_usuario' => session('id_usuario'),
            'tarea' => $request->tarea,
            'horario' => $request->horario,
            'tipo_gestion' => $request->tipo_gestion,
            'nombre_cliente' => $request->nombre_cliente,
        ]);
        return 'success';
    }
    public function buscarNotificaciones()
    {
        $fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->toDateTimeString();
        Tarea::where('horario', '<=', $fecha_actual)->where('estado', 1)->update([
            'estado' => 4
        ]);
        // verificar si debe enviar correo
        $enviarEmail = Tarea::where('estado', 4)->get();
        foreach ($enviarEmail as $value) {
            $usuario = DB::table('aw_users')->where('id_usuario', $value->id_usuario)->first();
            $correo = new RecordatorioMailable($value);
            Mail::to($usuario->usuario)->send($correo);
            Tarea::where('estado', 4)->update([
                'estado' => 2
            ]);
        }

        $tareas = Tarea::where('estado', 2)->where('id_usuario', session('id_usuario'))
            ->get();
        $notifications = [];

        foreach ($tareas as  $tarea) {
            array_push($notifications, [
                'icon' => 'fas fa-fw fa-clock',
                'text' => $tarea->tarea,
                'time' => $tarea->created_at->diffForHumans(),
                'id'   => $tarea->id,
                'nombre_cliente' => $tarea->nombre_cliente,
            ]);
        };
        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = '<i class="mr-1"><svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.0964 16.6667C12.0964 18.5077 10.6039 20 8.76297 20C6.922 20 5.42969 18.5077 5.42969 16.6667C5.42969 14.8257 6.922 13.3333 8.76297 13.3333C10.6039 13.3333 12.0964 14.8257 12.0964 16.6667Z" fill="#22215B"/>
            <path d="M14.603 9.93424C11.778 9.5308 9.59641 7.1016 9.59641 4.16673C9.59641 3.33329 9.77463 2.54258 10.0905 1.82496C9.66385 1.72501 9.22058 1.66673 8.76297 1.66673C5.54642 1.66673 2.92969 4.2833 2.92969 7.50001V9.82331C2.92969 11.4725 2.20718 13.0292 0.939636 14.1008C0.61554 14.3774 0.429688 14.7817 0.429688 15.2083C0.429688 16.0126 1.08383 16.6667 1.88797 16.6667H15.638C16.4423 16.6667 17.0964 16.0126 17.0964 15.2083C17.0964 14.7817 16.9106 14.3774 16.5781 14.0933C15.3481 13.0525 14.6347 11.5416 14.603 9.93424Z" fill="#22215B"/>
            <path d="M19.5964 4.16672C19.5964 6.4679 17.7309 8.33328 15.4297 8.33328C13.1285 8.33328 11.263 6.4679 11.263 4.16672C11.263 1.86554 13.1285 0 15.4297 0C17.7309 0 19.5964 1.86554 19.5964 4.16672Z" fill="#4CE364"/>
            </svg></i>';

            $time = "<span class='float-right text-muted text-sm'>
                   {$not['time']}
                 </span>";

            $dropdownHtml .= "<a href='#' id='{$not['id']}' class='notify dropdown-item'>
                            <div class='card__message text-muted text-sm'>
                            <div class='text-oculto'>{$icon} <strong>{$not['nombre_cliente']}</strong></div>
                            <div class='text-oculto'>{$not['text']}{$time}</div>
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
    public function notificaciones()
    {
        $tareas = Tarea::where('id_usuario', session('id_usuario'))->where('estado',3)->orWhere(function($query) {
            $query->where('id_usuario', session('id_usuario'))
                  ->where('estado',2);
        })->get();
        return view('recordatorios.index', compact('tareas'));
    }
    public function marcarLeida($id_notificacion)
    {
        $tarea = Tarea::where('id', $id_notificacion)->update([
            'estado' => 3,
        ]);

        return 'success';
    }
    public function validacionClientesEtapa(Request $request)
    {
        $etapa = EtapaHasCliente::where('id_etapa', $request->id)->get();
        if ($etapa->count() == 0) {
            Etapa::where('id', $request->id)->delete();
        }
        return $etapa->count();
    }

    public function reporte()
    {
        $response = '';
        $comment = Comentario::where('id_usuario', session('id_usuario'))->join('aw_clientes', 'aw_clientes.id_cliente', '=', 'comentarios.id_cliente')
            ->select('comentarios.*', 'aw_clientes.*')->get();
        if (count($comment) == 0) {
            $comment = 'no data';
        }
        $response = json_encode($comment);
        return $response;
    }
    public function eliminarTarea(Request $request)
    {
        Tarea::where('id', $request->id_tarea)->delete();
        return 'success';
    }

    public function cartera()
    {
        $user = DB::table('aw_users')
                ->where('id_usuario', session('id_usuario'))
                ->first();
        $cartera = DB::table('carteras')->first();
        $giras = Gira::all(['nombre','id']);
        return view('cartera.index', compact('cartera','giras','user'));
    }

    public function saveExcel(Request $request)
    {

        $request->validate([
            'excel' => 'required|max:10000|mimes:xlsx,xls'
        ]);

        // Obtener fechas de inicio y fin 
        $fechas = $request->rango_fecha;
        $fechas =  explode(' - ',$fechas);
        $fecha_inicio =  DateTime::createFromFormat('d/m/Y', $fechas[0])->format('Y-m-d');
        $fecha_fin = DateTime::createFromFormat('d/m/Y', $fechas[1])->format('Y-m-d');
        //  
        $file_array = explode(".", $_FILES["excel"]["name"]);
        $file_extension = end($file_array);

        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($_FILES["excel"]["tmp_name"], $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActiveSheet()->toArray(null, false, false, false);

        $mensaje = 'Cartera de clientes cargada correctamente';

        foreach ($data as $key => $row) {
            if ($key == 0) {
                if(strtoupper($row[0]) != 'CODIGO'){
                    $mensaje = 'Error: Columna 1 debe llamarse "CODIGO"';
                    break;
                }                
                if(strtoupper($row[1]) != 'CLIENTE'){
                    $mensaje = 'Error: Columna 2 debe llamarse "CLIENTE"';
                    break;
                }                
                if(strtoupper($row[2]) != 'TIPO CLIENTE'){
                    $mensaje = 'Error: Columna 3 debe llamarse "TIPO CLIENTE"';
                    break;
                }                
                if(strtoupper($row[3]) != 'ZONA'){
                    $mensaje = 'Error: Columna 4 debe llamarse "ZONA"';
                    break;
                }                
                if(strtoupper($row[4]) != 'GIRA'){
                    $mensaje = 'Error: Columna 5 debe llamarse "GIRA"';
                    break;
                }                
                if(strtoupper($row[5]) != 'VENDEDOR'){
                    $mensaje = 'Error: Columna 6 debe llamarse "VENDEDOR"';
                    break;
                }                
                if(strtoupper($row[6]) != 'N. DOCUMENTO'){
                    $mensaje = 'Error: Columna 7 debe llamarse "N. DOCUMENTO"';
                    break;
                }                
                if(strtoupper($row[7]) != 'TIPO DOCUMENTO'){
                    $mensaje = 'Error: Columna 8 debe llamarse "TIPO DOCUMENTO"';
                    break;
                }                
                if(strtoupper($row[8]) != 'F. COMERCIAL'){
                    $mensaje = 'Error: Columna 9 debe llamarse "F. COMERCIAL"';
                    break;
                }                
                if(strtoupper($row[9]) != 'FECHA EMISION'){
                    $mensaje = 'Error: Columna 10 debe llamarse "FECHA EMISION"';
                    break;
                }                
                if(strtoupper($row[10]) != 'TOTAL'){
                    $mensaje = 'Error: Columna 11 debe llamarse "TOTAL"';
                    break;
                }                
                if(strtoupper($row[11]) != 'SALDO FACTURADO'){
                    $mensaje = 'Error: Columna 12 debe llamarse "SALDO FACTURADO"';
                    break;
                }                
                if(strtoupper($row[12]) != 'SALDO'){
                    $mensaje = 'Error: Columna 13 debe llamarse "SALDO"';
                    break;
                }                
                if(strtoupper($row[13]) != 'FECHA'){
                    $mensaje = 'Error: Columna 14 debe llamarse "FECHA"';
                    break;
                }

            }else{

                if(!empty($row[9])){
                    
                    $fecha_emision = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[9]));
                    $fecha_emision = date_format($fecha_emision, 'Y-m-d');
                }
                if(!empty($row[13])){
                    $fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[13]));
                    $fecha = date_format($fecha, 'Y-m-d');
                }
                if(!empty($row[10])){
                    $val = explode('$', $row[10]);
                    if($val[0] != ' '){
                        $total = $row[10];
                    }else{
                        $total = $val[1];
                    }
                }
                if(!empty($row[11])){
                    $val = explode('$', $row[11]);
                    if($val[0] != ' '){
                        $saldo_factura = floatval ($row[11]);
                    }else{
                        $saldo_factura = floatval ($val[1]);
                    }
                }
                if(!empty($row[12])){
                    $val = explode('$', $row[12]);
                    if($val[0] != ' '){
                        $saldo = floatval ($row[12]);
                    }else{
                        $saldo = floatval ($val[1]);
                    }
                }
                $insert_data = array(
                    'codigo'  => $row[0],
                    'cliente'  => $row[1],
                    'tipo_cliente'  => $row[2],
                    'zona'  => $row[3],
                    'gira'  => $row[4],
                    'vendedor' => $row[5],
                    'n_documento'  => $row[6],
                    'tipo_documento'  => $row[7],
                    'f_comercial'  => $row[8],
                    'fecha_emision'  => $fecha_emision,
                    'total'  => $total,
                    'saldo_factura'  => $saldo_factura,
                    'saldo'  => $saldo,
                    'fecha'  => $fecha,
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'id_gira' => $row[14],
                    'fecha_inicio'=> $fecha_inicio,
                    'fecha_fin'=> $fecha_fin,
                );

                DB::table('carteras')->insert($insert_data);
            }
        }

        return redirect()->route('fase.cartera')->with('mensaje', $mensaje);
    }

    public function update_presupuesto(Request $request)
    {
        $data = $request->all();

        $presupuesto = $data['presupuesto'];

        $user = DB::table('aw_users')
                ->where('id_usuario', session('id_usuario'))
                ->update(['presupuesto_semanal' => floatval($presupuesto)]);

        return $user;
    }
    
    public function reporteCartera()
    {
        $ultimaCartera = DB::table('carteras')->orderByDesc('id')->limit(1)->get();
        $ultimaCartera = $ultimaCartera[0];

        $usuarios = DB::table('aw_users')->where('tipo_usuario','vendedor')->get();
        $data = DB::select(DB::raw("select au.nombre_usuario, sum(c.saldo) as ppt, g.nombre as gira , c.fecha_inicio,c.fecha_fin,
        IFNULL((select sum(c.valor_recaudado) from aw_users u join comentarios c on c.id_usuario = u.id_usuario where u.nombre_usuario  = au.nombre_usuario 
        group by u.nombre_usuario),0) as recaudado
        from aw_users au 
        join giras g on au.id_usuario = g.id_usuario 
        join carteras c on c.id_gira = g.id
        where au.tipo_usuario = 'vendedor' and c.fecha_inicio = '$ultimaCartera->fecha_inicio'
        group by au.nombre_usuario ,g.nombre  ,c.fecha_inicio ,c.fecha_fin "));
        
        return view('cartera.reporte',compact('usuarios','data'));
    }
}
