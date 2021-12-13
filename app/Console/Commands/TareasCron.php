<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tarea;
use App\Events\RealTimeMessage;

class TareasCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarea:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca si hay recordatorios pendientes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tareas = Tarea::get();
        $horario = date('Y-m-d H:i:s');
        $horario = explode(':',$horario);
        $horario = $horario[0].':'.$horario[1];

        foreach ($tareas as $tarea) {
            $horarioTarea = $tarea->horario;
            $horarioTarea = explode(':',$horarioTarea);
            $horarioTarea = $horarioTarea[0].':'.$horarioTarea[1];
            if ($horarioTarea == $horario) {
                event(new RealTimeMessage($tarea->tarea));
            }
        }
        return Command::SUCCESS;
    }
}
