<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col my-auto text-left">

            </div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Bienvenido a STREAK {{ $user->nombre_usuario }}</h2>
            </div>
            <div class="col my-auto text-right">
                @if ($user->tipo_usuario == 'administrador')
                    <a class="btn btn-warning btn-sm" href="{{ route('fase.reporte') }}"><i class="fas fa-file-alt"></i>
                        Reportes</a>
                @endif
                @if ($user->tipo_usuario == 'administrador')
                    <a class="btn btn-primary btn-sm" href="{{ route('giras.create') }}"><i
                            class="fas fa-plus mr-1"></i>Nueva
                        Gira</a>
                @endif
            </div>
        </div>
    @stop
    <div class="container">
        @if (!empty($_GET['message']))
            <div class="alert alert-success">
                <p>GIRA CREADA CORRECTAMENTE</p>
            </div>
        @elseif (!empty($_GET['edit']))
            <div class="alert alert-info">
                <p>GIRA EDITADA CORRECTAMENTE</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
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
                            @foreach ($giras as $gira)
                                @if ($user->tipo_usuario != 'administrador')
                                    @if ($user->id_usuario == $gira->id_usuario)
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
                                                        <img alt="Avatar" class="table-avatar"
                                                            title="{{ $gira->nombre_usuario }}"
                                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfPgS1h_HJXlk30XL589iPYN7jbjLdXRYKxA&usqp=CAU">
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span
                                                            class="badge bg-dark">{{ $gira->nombre_usuario }}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="project_progress">
                                                @php
                                                    $cant_clientes = App\Models\Etapa::where('id_gira', $gira->id)
                                                        ->join('etapa_has_clientes', 'etapa_has_clientes.id_etapa', '=', 'etapas.id')
                                                        ->selectRow('count(etapa_has_clientes.id)')
                                                        ->get();
                                                    dd($cant_clientes);
                                                @endphp
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-green" role="progressbar"
                                                        aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 57%">
                                                    </div>
                                                </div>
                                                <small>
                                                    57% Completo
                                                </small>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-success">{{ $gira->estado }}</span>
                                            </td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('fase.gira', $gira->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                </a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('giras.edit', $gira->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @else
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
                                                    <img alt="Avatar" class="table-avatar"
                                                        title="{{ $gira->nombre_usuario }}"
                                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfPgS1h_HJXlk30XL589iPYN7jbjLdXRYKxA&usqp=CAU">
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="badge bg-dark">{{ $gira->nombre_usuario }}</span>
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
                                                    <div class="progress-bar bg-green" role="progressbar"
                                                        aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: {{ $progreso }}%">
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
                                            <span class="badge badge-success">{{ $gira->estado }}</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('fase.gira', $gira->id) }}">
                                                <i class="fas fa-folder">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('giras.edit', $gira->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</x-plantilla>
