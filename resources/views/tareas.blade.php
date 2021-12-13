@php
    use App\Models\Tarea;

$tareas = Tarea::get();
$horario = date('Y-m-d H:i:s');
$horario = explode(':',$horario);
$horario = $horario[0].':'.$horario[1];

foreach ($tareas as $tarea) {
    $horarioTarea = $tarea->horario;
    $horarioTarea = explode(':',$horarioTarea);
    $horarioTarea = $horarioTarea[0].':'.$horarioTarea[1];
    if ($horarioTarea == $horario) {
        event(new App\Events\RealTimeMessage('Hello World'));
    }
}
@endphp