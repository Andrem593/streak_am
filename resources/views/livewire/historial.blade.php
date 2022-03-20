<div>
    @section('content_header')
    <div class="card redondeado m-1 p-4 shadow bg-degrade">
        <div class="row d-flex justify-content-around">
            <div class="col">
                <h5 class="fw-bold my-2">{{$gira->nombre}} <i class="fas fa-chevron-right"></i> <span
                        id="nombre_cliente">{{$cliente->nombre}}</span></h5>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                        class="fas fa-arrow-left mr-1"></i>Regresar</a>
            </div>
        </div>
    </div>
    @stop
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card {{$open ? '': 'collapsed-card'}} shadow redondeado">
                        <div class="card-header text-secondary redondeado-card">
                            <h3 class="card-title fw-bold"><i class="fas fa-sticky-note"></i> AGREGAR
                                COMENTARIOS</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Comentario de {{$usuario->nombre_usuario}}</label>
                                <textarea class="form-control" rows="3" wire:model.defer="comentario"
                                    placeholder="Añadir nuevos comentarios ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo de Gestion</label>
                                <select class="custom-select" wire:model="select">
                                    <option value="" selected>Seleccione una opcion</option>
                                    <option value="PEDIDO">PEDIDO</option>
                                    <option value="COBRANZAS">COBRANZAS</option>
                                    <option value="LLAMADAS">LLAMADAS</option>
                                    <option value="VISITAS">VISITAS</option>
                                </select>
                            </div>
                            @if ($select == 'COBRANZAS')
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Tipo</label>
                                            <select class="custom-select" wire:model='tipo_documento'>
                                                <option value="">SELECCIONE</option>
                                                <option value="CHEQUE">CHEQUE</option>
                                                <option value="DEPOSITO">DESPOSITO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">N° Recibo</label>
                                            <input type="number" class="form-control" wire:model.defer='num_recibo' >
                                        </div>
                                    </div>    
                                </div>                            
                                <div class="form-group">
                                    <label for="">Valor Recaudado</label>
                                    <input type="number" wire:model.defer='valor_recudado' class="form-control" >
                                </div>

                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" wire:click="aggComentario()"
                                class="btn btn-primary float-right">AGREGAR</button>
                        </div>
                    </div>
                    <div class="card shadow redondeado">
                        <div class="card-header redondeado-card">
                            <h3 class="card-title text-info"> <i class="fas fa-clipboard"></i> HISTORIAL</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container-fluid">

                                <!-- Timelime example  -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- The time line -->
                                        <div class="timeline">
                                            @if ($comentarios->count() > 0)
                                            @foreach ($comentDay as $key => $item )
                                            <div class="time-label">
                                                <span class="bg-info">{{$key}}</span>
                                            </div>
                                            @foreach ($item as $val)
                                            @if ($val->tipo == 'comentario')
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i>
                                                        {{$val->created_at->diffForHumans()}}</span>
                                                    <h3 class="timeline-header"><a href="#">{{$val->nombre_usuario}}
                                                        </a> comento en {{$val->nombre_etapa}} </h3>
                                                    <div class="timeline-body">
                                                        <p class="my-2">{{$val->comentario}}</p>
                                                        <span><b>Tipo de Gestion:</b> {{$val->tipo_gestion}}</span>
                                                        @empty(!$val->valor_recaudado)
                                                        <span class="ml-4"><b>Valores recaudado:</b>
                                                            {{number_format($val->valor_recaudado,2)}}</span>
                                                        @endempty
                                                    </div>
                                                    @foreach ($item as $val)
                                                        @if ($val->tipo == 'comentario')
                                                            <div>
                                                                <i class="fas fa-comments bg-warning"></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i class="fas fa-clock"></i> {{$val->created_at->diffForHumans()}}</span>
                                                                    <h3 class="timeline-header"><a href="#">{{$val->nombre_usuario}} </a> comento en {{$val->nombre_etapa}} </h3>
                                                                    <div class="timeline-body">
                                                                        <p class="my-2">{{$val->comentario}}</p>
                                                                        <span><b>Tipo de Gestion:</b> {{$val->tipo_gestion}}</span>   
                                                                        @empty(!$val->valor_recaudado)                                                                            
                                                                            <span class="ml-4"><b>Valores recaudado:</b> {{number_format($val->valor_recaudado,2)}}</span> 
                                                                            <br>
                                                                            <span><b>Tipo Documento:</b> {{$val->tipo_documento}}</span>
                                                                            <span class="ml-4"><b>Número recibo:</b> {{$val->num_recibo}}</span> 
                                                                        @endempty
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <i class="fas fa-user bg-green"></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i class="fas fa-clock"></i> {{$val->created_at->diffForHumans()}}</span>
                                                                    <h3 class="timeline-header no-border"><a href="#">{{$val->nombre_usuario}}</a>
                                                                        {{$val->comentario}} <span class="badge {{$val->color}}">{{$val->nombre_etapa}}</span></h3>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach                                                
                                                <div>
                                                    <i class="fas fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                            @else
                                            <div>
                                                <i class="fas fa-user bg-green"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i>
                                                        {{$val->created_at->diffForHumans()}}</span>
                                                    <h3 class="timeline-header no-border"><a
                                                            href="#">{{$val->nombre_usuario}}</a>
                                                        {{$val->comentario}} <span
                                                            class="badge {{$val->color}}">{{$val->nombre_etapa}}</span>
                                                    </h3>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @endforeach
                                            <div>
                                                <i class="fas fa-clock bg-gray"></i>
                                            </div>
                                            @else
                                            <div>
                                                <i class="fas fa-clock bg-gray"></i>
                                                <div class="timeline-item">
                                                    <h3 class="timeline-header no-border">
                                                        Sin comentarios Hasta el momento</h3>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    @empty (!$errorComentario)
                    <div class="callout callout-danger">
                        <h5>{{$usuario->nombre_usuario}} tu comentario no pudo ser agregado!</h5>
                        <p>Verifica que el campo de comentario y tipo de gestion no esten vacios.</p>
                    </div>
                    @endempty
                    <div class="card redondeado shadow">
                        <div class="card-header redondeado-card">
                            <h3 class="card-title text-info"><i class="fas fa-caret-right"></i> ETAPAS</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Modificar la Etapa Actual</label>
                                <select wire:change="cambiarEtapa" wire:model='etapa_actual'
                                    class="custom-select form-control-border border-width-2 border-info">
                                    @foreach ($etapas_gira as $etapa )
                                    <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card redondeado shadow">
                        <div class="card-header redondeado-card">
                            <h3 class="card-title text-primary"><i class="fas fa-clock"></i> RECORDATORIOS</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tarea:</label>
                                <input type="text" id="tarea" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tipo de Gestion</label>
                                <select id="select_recordatorio" class="custom-select">
                                    <option value="" selected>Seleccione una opcion</option>
                                    <option value="PEDIDO">PEDIDO</option>
                                    <option value="COBRANZAS">COBRANZAS</option>
                                    <option value="LLAMADAS">LLAMADAS</option>
                                    <option value="VISITAS">VISITAS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                @section('plugins.TempusDominusBs4', true)
                                @php
                                $config = ['format' => 'DD/MM/YYYY HH:mm', 'minDate' => 'js:moment()', 'showClear' =>
                                true];

                                @endphp
                                <x-adminlte-input-date id="horario" name="idLabel" :config="$config"
                                    placeholder="Escige una fecha..." label="Fecha y Hora">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-clock"
                                            title="escoge el horario" />
                                    </x-slot>
                                </x-adminlte-input-date>

                            </div>
                            <button id="guardar_recordatorio" class="btn btn-primary float-right"><i
                                    class="fas fa-save"></i>
                                GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>


        </section>

    @push('js')
    <script>
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $('#guardar_recordatorio').click(function() {
                    let fecha = $('#horario').val() + ":00"
                    fecha = fecha.split(' ');
                    let hora = fecha[1]
                    fecha = fecha[0]
                    fecha = fecha.split('/')
                    fecha = fecha[2] + "-" + fecha[1] + "-" + fecha[0] + " " + hora

                    let data = {
                        'tarea': $('#tarea').val(),
                        'horario': fecha,
                        'tipo_gestion': $('#select_recordatorio').val(),
                        'nombre_cliente': $('#nombre_cliente').text(),
                    }
                    if($('#tarea').val() != '' &&  $('#horario').val() != '' && $('#select_recordatorio').val() != '' ){
                        $.post({
                            url: '{{ route('crearTarea') }}',
                            data: data,
                            beforeSend: function() {},
                            success: function(response) {
                                if (response.trim() == 'success') {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Tarea Creada'
                                    })
                                    $('#horario').val('')
                                    $('#tarea').val('')
                                }
                            }
                        })
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: 'Verifique los campos vacios'
                        })
                    }
                })

    </script>
    @endpush

</div>