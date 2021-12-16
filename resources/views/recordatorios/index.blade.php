<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Todas las Notificaciones</h2>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fas fa-chevron-left mr-1"></i>
                    Volver</a>
            </div>
        </div>
    @stop
    <div>

        <div class="card shadow p-2">
            @if ($tareas->count() > 0)
                <div class="card-header">
                    <h3 class="card-title">Tienes Actualemente {{$tareas->count()}} recordatorios pendientes</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col-md-4"><img src="{{url('images/sin_notificaciones.svg')}}" alt="sin notificaciones" width="100%"></div>
                        <div class="col">
                            <div class="list-group">
                                @foreach ($tareas as $tarea)
                                    <a href="#" id="{{$tarea->id}}" class="notify notification-element">
                                        <div class="card__message row border-bottom py-3">
                                            <div class="col-2 col-md-1 my-auto  text-center">
                                                <svg width="2rem" height="2rem" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.0964 16.6667C12.0964 18.5077 10.6039 20 8.76297 20C6.922 20 5.42969 18.5077 5.42969 16.6667C5.42969 14.8257 6.922 13.3333 8.76297 13.3333C10.6039 13.3333 12.0964 14.8257 12.0964 16.6667Z"
                                                        fill="#22215B" />
                                                    <path
                                                        d="M14.603 9.93424C11.778 9.5308 9.59641 7.1016 9.59641 4.16673C9.59641 3.33329 9.77463 2.54258 10.0905 1.82496C9.66385 1.72501 9.22058 1.66673 8.76297 1.66673C5.54642 1.66673 2.92969 4.2833 2.92969 7.50001V9.82331C2.92969 11.4725 2.20718 13.0292 0.939636 14.1008C0.61554 14.3774 0.429688 14.7817 0.429688 15.2083C0.429688 16.0126 1.08383 16.6667 1.88797 16.6667H15.638C16.4423 16.6667 17.0964 16.0126 17.0964 15.2083C17.0964 14.7817 16.9106 14.3774 16.5781 14.0933C15.3481 13.0525 14.6347 11.5416 14.603 9.93424Z"
                                                        fill="#22215B" />
                                                    <path
                                                        d="M19.5964 4.16672C19.5964 6.4679 17.7309 8.33328 15.4297 8.33328C13.1285 8.33328 11.263 6.4679 11.263 4.16672C11.263 1.86554 13.1285 0 15.4297 0C17.7309 0 19.5964 1.86554 19.5964 4.16672Z"
                                                        fill="#4CE364" />
                                                </svg>
                                            </div>
                                            <div class="col">
                                                <span class="text-muted">Recordatorio pendiente {{$tarea->created_at->diffForHumans()}}</span>
                                                <p class="mb-0">{{$tarea->tarea}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            @else
            <div class="card-header">
                <h3 class="card-title">Actualemente <b>NO</b> tienes recordatorios pendientes</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body pb-3">
                <div class="list-group">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{url('images/notificaciones.svg')}}" alt="sin notificaciones" width="100%">
                        </div>
                        <div class="col my-auto">
                            <p class="text-muted" style="font-size: 2rem">Puedes crear recordatorios en el apartado de historial del clientes para empezar a tener notificaciones.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-plantilla>
