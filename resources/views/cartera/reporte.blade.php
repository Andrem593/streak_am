<x-plantilla>
    @section('content_header')
        <div class="card redondeado m-1 p-4 shadow bg-degrade">
            <div class="row d-flex justify-content-around">
                <div class="col">
                    <h2 class="fw-bold my-2" style="font-size: 20px">Reporte de Cartera</h2>
                </div>
                <div class="col my-auto text-right">
                    <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                            class="fas fa-arrow-left mr-1"></i>Regresar</a>
                </div>
            </div>
        </div>
    @stop

    <div class="card shadow redondeado">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="cmb_user">Vendedor</label>
                        <select class="custom-select" id="cmb_user">
                            <option value="all">Seleccionar Todos</option>
                            @foreach ($usuarios as $item)
                                <option value="{{ $item->id_usuario }}">{{ $item->nombre_usuario }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="cmb_gira">Gira</label>
                        <select class="custom-select" id="cmb_gira">
                            <option value="">Seleccionar gira</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" id="btn_buscar"><i class="fas fa-search"></i> Buscar</button>
                    <button class="btn btn-secondary" onclick="limpiar()"><i class="fas fa-broom"></i>
                        Limpiar</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped projects text-center table-bordered" id="reports">
                    <thead>
                        <tr>
                            <th>VENDEDOR</th>
                            <th>PPT GIRA</th>
                            <th>COBRADO EN GIRA</th>
                            <th>%COBRO EN GIRA</th>                            
                            <th>GIRA</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $presupuesto = 0;
                            $gira = 0;
                        @endphp
                        @foreach ($data as $val)
                            <tr>
                                <th>{{$val->nombre_usuario}}</th>
                                <td>$ {{$val->ppt}}</td>
                                <td>$ {{$val->recaudado}}</td>
                                <td>{{number_format(($val->recaudado / $val->ppt) * 100,2) }}%</td>
                                <th>{{$val->gira}}</th>
                            </tr>
                            @php
                                $presupuesto += $val->ppt;
                                $gira += $val->recaudado;  
                            @endphp
                        @endforeach
                        <tfoot>
                            <tr>
                                <th>TOTAL: </th>
                                <th>$ {{$presupuesto}}</th>
                                <th>$ {{$gira}}</th>
                                <th>{{number_format(($gira / $presupuesto) * 100,2) }}%</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-plantilla>
