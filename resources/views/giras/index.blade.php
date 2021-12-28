<x-plantilla>
    @section('content_header')
    <div class="card redondeado m-1 p-4 shadow bg-degrade">
        <div class="row d-flex justify-content-around">
            <div class="col">
                <h2 class="fw-bold my-2" style="font-size: 20px">Bienvenido a STREAK {{ $user->nombre_usuario }}</h2>
            </div>
            <div class="col my-auto text-right">
                <x-adminlte-button label="Presupuesto semanal" data-toggle="modal" data-target="#modalPurple"
                    class="btn btn-success btn-sm" icon="fas fa-dollar-sign" />
                <a class="btn btn-warning btn-sm" href="{{ route('fase.reporte') }}"><i class="fas fa-file-alt"></i>
                    Reportes</a>
                @if ($user->tipo_usuario == 'administrador')
                <a class="btn btn-primary btn-sm" href="{{ route('giras.create') }}"><i
                        class="fas fa-plus mr-1"></i>Nueva
                    Gira</a>
                @endif
            </div>
        </div>
    </div>
    @stop

    @if (!empty($_GET['message']))
    <div class="alert alert-success">
        <p>GIRA CREADA CORRECTAMENTE</p>
    </div>
    @elseif (!empty($_GET['edit']))
    <div class="alert alert-info">
        <p>GIRA EDITADA CORRECTAMENTE</p>
    </div>
    @endif
    <div class="card shadow-lg redondeado">
        <div class="card-header bg-success redondeado-card">
            <h3 class="card-title">Lista de Giras Actuales</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="minimizar">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Nombre de Gira
                            </th>
                            <th style="width: 30%">
                                Usuarios Asignados
                            </th>
                            <th>
                                Progreso
                            </th>
                            <th style="width: 8%" class="text-center">
                                Estado
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="row p-0 m-0">
                            <div class="col p-1">
                                {{-- <form class="form-inline ml-3" method="GET" action="{{ route('giras') }}"> --}}
                                    <div class="input-group input-group-sm p-1">
                                        <input type="hidden" id="id_cliente" name="id_cliente">
                                        <input class="form-control form-control-navbar" type="search"
                                            placeholder="Buscar clientes" aria-label="Search" id="txt_cliente">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{--
                                </form> --}}
                            </div>
                        </div>
                        @if (count($giras) > 0)
                        @foreach ($giras as $gira)
                        <tr>
                            <td>
                                {{ $i++ }}
                            </td>
                            <td>
                                <a>
                                    {{ $gira->nombre }}
                                </a>
                                <br>
                                <small>
                                    Creada {{ $gira->created_at->diffForHumans() }}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" title="{{ $gira->nombre_usuario }}"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfPgS1h_HJXlk30XL589iPYN7jbjLdXRYKxA&usqp=CAU">
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="badge bg-info">{{ $gira->nombre_usuario }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="project_progress">
                                @php
                                $cant_clientes = App\Models\Etapa::where('id_gira', $gira->id)
                                ->join('etapa_has_clientes', 'etapa_has_clientes.id_etapa', '=', 'etapas.id')
                                ->select(DB::raw('count(etapa_has_clientes.id) as total'))
                                ->first();
                                $cant_visitas = App\Models\Etapa::where('id_gira', $gira->id)
                                ->join('etapa_has_clientes', 'etapa_has_clientes.id_etapa', '=', 'etapas.id')
                                ->where('etapas.nombre', '=', 'VISITAS')
                                ->select(DB::raw('count(etapa_has_clientes.id) as total'))
                                ->first();
                                $progreso = 0;
                                if ($cant_clientes->total > 0) {
                                $progreso = ($cant_visitas->total / $cant_clientes->total) * 100;
                                $progreso = number_format($progreso);
                                }
                                @endphp
                                @if ($cant_clientes->total > 0)
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-degrade" role="progressbar" aria-valuenow="57"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $progreso }}%">
                                    </div>
                                </div>
                                <small>
                                    {{ $progreso }}% Completo
                                </small>
                                @else
                                <div class="text-muted">
                                    Sin clientes en Gira
                                </div>

                                @endif
                            </td>
                            <td class="project-state">
                                <span class="badge bg-success">{{ $gira->estado }}</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('fase.gira', $gira->id) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('giras.edit', $gira->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">
                                <h6>No hay giras disponibles</h6>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Presupuesto semanal" theme="navy" icon="fas fa-dollar-sign" size='md'>
        <div class="row">
            <x-adminlte-input id="txt_presupuesto" name="erro" placeholder="Ingrese su presupuesto semanal"
                type="number" fgroup-class="col" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="btn btn-primary" label="Guardar" id="btn_guardar" />
            <x-adminlte-button theme="btn btn-secondary" label="Cancelar" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    {{-- Example button to open modal --}}

    @push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />
    @endpush

    @push('js')
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
        let path = "{{ route('web.autocompletar') }}";

            $('#txt_cliente').autocomplete({
                source: function(request, response) {
                    $.getJSON(path, {
                            term: request.term,
                            only: 'etapaCliente'
                        },
                        response
                    );
                },
                focus: function(event, ui) {
                    $("#txt_cliente").val(ui.item.value);
                    return false;
                },
                minLength: 1,
                select: function(event, ui) {
                    $('#id_cliente').val(ui.item.id);
                    $(location).attr('href', '{{ url('historial') }}/' + ui.item.id + '/' + ui.item.id_etapa +
                        '/' + ui.item.id_gira);
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                if (item.value) {
                    return $("<li>").append("<div><span>" + item.ruc + "</span><br><span>" + item.value +
                            "</span></div>")
                        .appendTo(ul);
                } else {
                    return $("<li class='ui-state-disabled'>").append("<div>Cliente no encontrado</div>")
                        .appendTo(ul);
                }

            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            $(document).ready(function(){
                $(document).on('click', '#btn_guardar', function(){
                    let presupuesto = $('#txt_presupuesto').val();
                    $.post({
                        url: '{{ route("web.update-presupuesto") }}',
                        data: {
                            presupuesto
                        },
                        beforeSend: function() {},
                        success: function(response) {                            
                            if(response){
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Presupuesto actualizado'
                                })
                            }else{
                                Toast.fire({
                                    icon: 'danger',
                                    title: 'Ocurrió un error'
                                })
                            }
                            $('#modalPurple').modal('hide');
                            $('#txt_presupuesto').val('');
                        }
                    });
                });
            });
    </script>
    @endpush
</x-plantilla>