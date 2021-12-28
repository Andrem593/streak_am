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
        <div class="table-responsive">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Cliente
                        </th>
                        <th style="width: 20%">
                            Tipo de Documento
                        </th>
                        <th style="width: 15%">
                            Fecha Emisión
                        </th>
                        <th>
                            F.Comercial
                        </th>
                        <th class="text-center">
                            Total
                        </th>
                        <th class="text-center" style="width: 20%">
                            Suma de Saldo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div class="row p-0 m-0">
                        <div class="col p-1">
                            {{-- <form class="form-inline ml-3" method="GET" action="{{ route('giras') }}"> --}}
                            <div class="input-group input-group-sm p-1">
                                <input class="form-control form-control-navbar" type="search"
                                    placeholder="Buscar clientes" aria-label="Search" id="txt_cliente">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="guardar" wire:click="carteraCliente">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                    @empty(!$data_cartera)
                        @php
                            $sum_saldo = 0;
                            $sum_total = 0;
                            $prueba = collect($data_cartera)->groupBy('tipo_documento');
                        @endphp

                        @foreach ($prueba as $item)
                        @php
                            $fecha_temp = '0';
                        @endphp
                            @foreach ($item as $key => $val)
                                @php
                                    $sum_saldo = $sum_saldo + floatval($val->saldo_factura);
                                    $sum_total = $sum_total + floatval($val->saldo_factura);
                                    
                                @endphp

                                <tr>
                                    <td>{{ $loop->first ? $val->cliente : '' }}</td>
                                    <td>{{ $loop->first ? $val->tipo_documento : '' }}</td>
                                    <td>{{ $fecha_temp != $val->fecha_emision ? $val->fecha_emision : '' }}</td>
                                    <td>{{ $val->f_comercial }}</td>
                                    <td class="text-center">$ {{ $val->total }}</td>
                                    <td class="text-center">$ {{ $val->saldo_factura }}</td>
                                </tr>
                                @if ($fecha_temp != $val->fecha_emision)
                                    {{$fecha_temp = $val->fecha_emision}}
                                @endif
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
                                <tr>
                                    <td></td>
                                    <td>Total </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">$ {{ $sum_total }}</td>
                                </tr>
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
            })
        </script>
    @endpush
</div>