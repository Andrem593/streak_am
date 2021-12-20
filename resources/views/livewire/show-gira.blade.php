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
                <div class="float-left{{ $options ? ' d-inline-block ' : ' d-none ' }}bg-light rounded shadow-sm py-1 px-2 w-50">
                    <div class="card-tool">
                            <button type="button" class="btn btn-tool align-middle" wire:click="clearSelected"><i
                                    class="fas fa-times"></i>
                            </button>
                            <span class="align-middle"><strong>{{ count($selectedClientes) }}</strong>
                                {{ count($selectedClientes) > 1 ? 'Clientes seleccionados' : 'Cliente seleccionado' }}</span>
                                <span class="align-middle border-right"></span>
                                <span class="align-middle pl-1 d-inline">
                                    <select class="custom-select text-center" id="cmb_etapa" wire:change="changeEtapa" wire:model='selectedEtapa' style="width: 34% !important;">
                                        <option value="">Pasar a etapa</option>
                                        @foreach ($etapas as $etapa)
                                            <option value="{{ $etapa->id }}">{{ $etapa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            @if ($usuario->tipo_usuario == 'administrador')
                            <span class="align-middle px-2"><i class="fas fa-ellipsis-v"></i></span>
                            <button type="button" class="align-middle btn btn-tool bg-danger" wire:click="deleteClientes"><i class="fas fa-trash"></i>
                            </button>    
                            @endif
                            
                    </div>

                </div>
                <div class="float-right row">
                    <a href="{{ route('giras.edit', $id_gira) }}" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    @livewire('off-canvas',['id_gira'=>$id_gira])
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
                        @php
                            $flag = 0;
                        @endphp
                        @foreach ($etapas as $etapa)
                            @php
                                $color = explode('-', $etapa->color);
                                $color = $color[1];
                            @endphp
                            <div class="card card-{{ $color }} card-outline">
                                <a class="d-block w-100 collapsed" data-toggle="collapse"
                                    href="#card{{ $etapa->id }}" aria-expanded="false">
                                    <div class="card-header my-auto">
                                        <h4 class="card-title w-100 text-{{ $color }}">
                                            {{ $etapa->nombre }}
                                            @empty(!$etapa->total)
                                                <span
                                                    class="badge badge-{{ $color }} right">{{ $etapa->total }}</span>
                                            @endempty
                                        </h4>
                                    </div>
                                </a>
                                <div id="card{{ $etapa->id }}"
                                    class="collapse {{ $collapse == true && $etapa->id == $primeraEtapa ? 'show' : '' }}"
                                    data-parent="#accordion" style="" wire:ignore.self>
                                    <div class="card-body">
                                        @empty(!$clientes_x_etapa)
                                            @foreach ($clientes_x_etapa_D as $item)
                                                @if ($item->id_etapa == $etapa->id)
                                                    @php
                                                        $flag = 1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($flag)
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">&nbsp;</th>
                                                            <th style="width: 10px">#</th>
                                                            <th>Asignado a</th>
                                                            <th>Provincia</th>
                                                            <th>Ciudad</th>
                                                            <th>Nombre</th>
                                                            <th>Teléfono</th>
                                                            <th>RUC</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($clientes_x_etapa as $cliente)
                                                            @if ($etapa->id == $cliente->id_etapa)
                                                                <tr>
                                                                    <td><a href="{{ route('fase.historial', ['id_cliente' => $cliente->id_cliente, 'id_etapa' => $cliente->id_etapa, 'id_gira' => $id_gira]) }}"
                                                                            class="btn btn-sm btn-info"><i
                                                                                class="fas fa-edit"></i></a>
                                                                    </td>
                                                                    <td><input type="checkbox" wire:model="selectedClientes"
                                                                            value="{{ $cliente->id_cliente }}"></td>
                                                                    <td>{{ $cliente->nombre_usuario }}</td>
                                                                    <td>{{ $cliente->nombre_provincia }}</td>
                                                                    <td>{{ $cliente->ciudad }}</td>
                                                                    <td>{{ $cliente->nombre }}</td>
                                                                    <td>{{ $cliente->telefono }}</td>
                                                                    <td>{{ $cliente->ruc }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            @else
                                                <h6>Sin Clientes</h6>
                                            @endif
                                        @endempty
                                    </div>
                                </div>
                            </div>
                            @php
                                $flag = 0;
                            @endphp
                        @endforeach
                    </div>
                </div>



            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
