<div>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h5 class="fw-bold my-2">B/D CLIENTES <i class="fas fa-chevron-right"></i> JUAN PEREZ PIGUAVE</h5>
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
                                <label for="exampleInputEmail1">Comentario</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Añadir nuevos comentarios ..."></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">AGREGAR</button>
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
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-red">10 Feb. 2021</span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i>
                                                        12:05</span>
                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                        email
                                                    </h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                                                        kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-primary btn-sm">Read more</a>
                                                        <a class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-green"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 5 mins
                                                        ago</span>
                                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a>
                                                        accepted
                                                        your friend request</h3>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 27 mins
                                                        ago</span>
                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                        your post
                                                    </h3>
                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-warning btn-sm">View comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-green">3 Jan. 2021</span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-video bg-maroon"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 5 days
                                                        ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video
                                                    </h3>

                                                    <div class="timeline-body">
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item"
                                                                src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                                allowfullscreen=""></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="fas fa-clock bg-gray"></i>
                                            </div>
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
                                <label for="exampleSelectBorderWidth2">Modificar la Etapa Actual</label>
                                <select class="custom-select form-control-border border-width-2"
                                    id="exampleSelectBorderWidth2">
                                    <option>B/D Clientes</option>
                                    <option>Por visitar</option>
                                    <option>Por Llamar</option>
                                    <option>Visitas</option>
                                    <option>Llamadas</option>
                                    <option>Pedidos</option>
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
                                <input type="datetime" class="form-control">
                            </div>
                            <div class="form-group">
                                {{-- <label>Fecha y Hora:</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="datetime" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime">
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> --}}
                                @section('plugins.TempusDominusBs4', true)
                                @php
                                    $config = ['format' => 'DD/MM/YYYY HH:mm',
                                    'minDate' => "js:moment()",
                                    'showClear' => true,];
                                    
                                @endphp
                                <x-adminlte-input-date name="idLabel" :config="$config" placeholder="Choose a date..."
                                    label="Fecha y Hora" >
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-clock"
                                            title="Set to Birthday" />
                                    </x-slot>
                                </x-adminlte-input-date>

                            </div>
                            <button class="btn btn-primary float-right"><i class="fas fa-save"></i>
                                GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>

    @push('js')
        <script>


        </script>
    @endpush

</div>
