<div class="card card-primary shadow redondeado card-outline">
    <div class="card-header">
        <h3 class="card-title">Consulta de cliente</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="minimizar">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Nombre Cliente</label>
                    <div class="input-group input-group-sm p-1">
                        <input class="form-control form-control-navbar" type="search"
                            placeholder="Escribe el nombre del cliente" aria-label="Search" id="txt_cliente">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="guardar" wire:click="carteraCliente">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label>Tipo Documento</label>
                    <select id="documento" class="form-control">
                        <option value="">TODOS</option>
                        @foreach ($tipo_documentos as $documento)
                        <option value="{{$documento->tipo_documento}}">{{$documento->tipo_documento}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered border-primary">
                <thead>
                    <tr>
                        <th style="width: 20%">
                            Cliente
                        </th>
                        <th style="width: 20%">
                            Tipo de Documento
                        </th>
                        <th style="width: 15%">
                            Fecha Emisión
                        </th>
                        <th style="width: 15%">
                            F.Comercial
                        </th>
                        <th class="text-center" style="width: 15%">
                            Total
                        </th>
                        <th class="text-center" style="width: 15%">
                            Suma de Saldo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div class="row p-0 m-0">
                        <div class="col p-1">
                            {{-- <form class="form-inline ml-3" method="GET" action="{{ route('giras') }}"> --}}

                                {{-- </form> --}}
                        </div>
                    </div>
                    @empty(!$data_cartera)
                    @php
                    $sum_saldo = 0;
                    $sum_total = 0;
                    $prueba = collect($data_cartera)->groupBy('tipo_documento');
                    // $cliente = $data_cartera[0]->cliente;
                    $cliente = '';
                    $Fecha = '';
                    @endphp

                    @foreach ($prueba as $item)
                    @foreach ($item as $key => $val)
                    @php
                    $sum_saldo = $sum_saldo + floatval($val->saldo_factura);
                    $sum_total = $sum_total + floatval($val->saldo_factura);
                    @endphp

                    <tr>
                        @if ($cliente != $val->cliente)
                        <td>{{$val->cliente}}</td>
                        @php
                        $cliente = $val->cliente;
                        @endphp
                        @else
                        <td></td>
                        @endif
                        <td>{{ $loop->first ? $val->tipo_documento : '' }}</td>
                        @if ($Fecha != $val->fecha_emision)
                        <td>{{$val->fecha_emision}}</td>
                        @php
                        $Fecha = $val->fecha_emision;
                        @endphp
                        @else
                        <td></td>
                        @endif
                        <td>{{ $val->f_comercial }}</td>
                        <td class="text-center">$ {{ $val->total }}</td>
                        <td class="text-center">$ {{ $val->saldo_factura }}</td>
                    </tr>
                    @if ($loop->last)
                    <tr>
                        <td></td>
                        <td>Total {{ $val->tipo_documento }} </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">$ {{ $sum_saldo }}</td>
                    </tr>
                    @php
                    $sum_saldo = 0;
                    @endphp
                    @endif
                    @endforeach
                    @if ($loop->last)
                <tfoot class="border-top-4">
                    <tr>
                        <td></td>
                        <td>Total </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">$ {{ $sum_total }}</td>
                    </tr>
                </tfoot>
                @endif
                @endforeach

                @endempty
                </tbody>
            </table>
        </div>
    </div>
    @push('js')
    <script>
        $('#guardar').click(function() {
            @this.set('nombre_cliente', $('#txt_cliente').val());
            @this.set('documento', $('#documento').val());
        })
    </script>
    @endpush
</div>