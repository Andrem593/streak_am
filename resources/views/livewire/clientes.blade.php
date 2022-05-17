<div>
    @section('content_header')
        <div class="card redondeado m-1 p-4 shadow-sm bg-degrade">
            <div class="row d-flex justify-content-around">
                <div class="col">
                    <h2 class="fw-bold my-2" style="font-size: 20px">Modulo de Clientes</h2>
                </div>
                <div class="col my-auto text-right">
                    <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                            class="fas fa-arrow-left mr-1"></i>Regresar</a>
                </div>
            </div>
        </div>
    @stop

    {{-- tabla de clientes --}}
    <div class="card shadow redondeado {{$edit ? 'd-none' : '' }}">
        <div class="card-header bg-success redondeado-card">
            <h3 class="card-title">Listado de Clientes</h3>

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
                            <th style="width: 10%">RUC</th>
                            <th style="width: 20%">Nombre</th>
                            <th style="width: 20%">email</th>
                            <th style="width: 10%">ciudad</th>
                            <th style="width: 10%">telefono</th>
                            <th style="width: 10%">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="row p-0 m-0">
                            <div class="col p-1">
                                <div class="input-group input-group-sm p-1">
                                    <input class="form-control form-control-navbar" type="search"
                                        placeholder="Buscar cliente" wire:model='cliente' aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($clientes) > 0)
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td style="width: 10%">{{ $cliente->ruc }}</td>
                                    <td style="width: 20%">{{ $cliente->nombre }}</td>
                                    <td style="width: 20%">{{ $cliente->email }}</td>
                                    <td style="width: 10%">{{ $cliente->ciudad }}</td>
                                    <td style="width: 10%">{{ $cliente->telefono }}</td>
                                    <td style="width: 10%">
                                        <button class="btn btn-sm btn-primary" wire:click="edit({{$cliente->id_cliente}})"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    NO HAY REGISTROS EN LA TABLA
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {{ $clientes->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- COMPONENTE PARA EDITAR CLIENTE --}}
    @include('components.formCliente')
</div>
