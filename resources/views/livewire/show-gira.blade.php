<div>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">{{ $gira->nombre }}</h2>
            </div>
            <div class="col my-auto text-right">
            </div>
        </div>
    @stop

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $gira->nombre }} {{ $clientes }}</h3>
                <div class="float-right">
                    @livewire('off-canvas',['id_gira'=>$id_gira] )
                </div>
            </div>
            <div class="card-body text-center p-0">
                <div class="row p-2">
                    <div class="col">
                        <ol class="breadcrumb">
                            @foreach ($etapas as $etapa)
                                <li class="{{ $etapa->color }}"><a data-toggle="collapse"
                                        href="#card{{ $etapa->id }}" class="my-auto">
                                        {{ $etapa->nombre }}</a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" id="accordion">
                        @foreach ($etapas as $etapa)
                            @php
                                $color = explode('-', $etapa->color);
                                $color = $color[1];
                            @endphp
                            <div class="card card-{{ $color }} card-outline">
                                <a class="d-block w-100 collapsed" data-toggle="collapse"
                                    href="#card{{ $etapa->id }}" aria-expanded="false">
                                    <div class="card-header">
                                        <h4 class="card-title w-100 text-{{ $color }}">
                                            {{ $etapa->nombre }}
                                        </h4>
                                    </div>
                                </a>
                                <div id="card{{ $etapa->id }}"
                                    class="collapse {{ $collapse == true && $etapa->id == $primeraEtapa ? 'show' : '' }}"
                                    data-parent="#accordion" style="">
                                    <div class="card-body">
                                        @empty(!$clientes_x_etapa)
                                            @foreach ($clientes_x_etapa_D as $item)
                                                @if ($item->id_etapa == $etapa->id)
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">&nbsp;</th>
                                                                <th style="width: 10px">#</th>
                                                                <th>Asignado a</th>
                                                                <th>Zona</th>
                                                                <th>Nombre</th>
                                                                <th>Teléfono</th>
                                                                <th>RUC</th>
                                                                <th>Notas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($clientes_x_etapa as $cliente)
                                                                @if ($etapa->id == $cliente->id_etapa)
                                                                    <tr>
                                                                        <td><a href="{{ route('fase.historial',['id_cliente'=>$cliente->id_cliente,
                                                                            'id_etapa'=>$cliente->id_etapa,'id_gira'=>$id_gira] ) }}"
                                                                                class="btn btn-sm btn-info"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                        </td>
                                                                        <td><input type="checkbox" /></td>
                                                                        <td>Usuario</td>
                                                                        <td>{{ $cliente->ciudad }}</td>
                                                                        <td>{{ $cliente->nombre }}</td>
                                                                        <td>{{ $cliente->telefono }}</td>
                                                                        <td>{{ $cliente->ruc }}</td>
                                                                        <td><span class="badge bg-danger">55%</span></td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <h5>Sin clientes</h5>
                                                @endif
                                            @endforeach
                                        @endempty
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
