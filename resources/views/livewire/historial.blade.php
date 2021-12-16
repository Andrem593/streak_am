<div>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h5 class="fw-bold my-2">{{$gira->nombre}} <i class="fas fa-chevron-right"></i> {{$cliente->nombre}}</h5>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-secondary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                        class="fas fa-arrow-left mr-1"></i>Regresar</a>
            </div>
        </div>
    @stop
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title text-success fw-bold"><i class="fas fa-sticky-note"></i> AGREGAR
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
                                <label for="exampleInputEmail1">Comentario de {{$usuario->nombre_usuario}}</label>
                                <textarea class="form-control" rows="3" wire:model.defer="comentario"
                                    placeholder="Añadir nuevos comentarios ..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" wire:click="aggComentario()"
                                class="btn btn-primary float-right">AGREGAR</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
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
                                                                    <span class="time"><i class="fas fa-clock"></i> {{$val->created_at->diffForHumans()}}</span>
                                                                    <h3 class="timeline-header"><a href="#">{{$val->nombre_usuario}} </a> comento en {{$val->nombre_etapa}} </h3>
                                                                    <div class="timeline-body">
                                                                        {{$val->comentario}}
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
                    <div class="card">
                        <div class="card-header">
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
                                <select wire:change="cambiarEtapa" wire:model='etapa_actual' class="custom-select form-control-border border-width-2 border-info">
                                    @foreach ($etapas_gira as $etapa )
                                        <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
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
                                @section('plugins.TempusDominusBs4', true)
                                    @php
                                        $config = ['format' => 'DD/MM/YYYY HH:mm', 'minDate' => 'js:moment()', 'showClear' => true];

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
        </div>

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
                    }
                    if($('#tarea').val() != '' &&  $('#horario').val() != '' ){
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
