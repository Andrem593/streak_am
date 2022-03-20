<x-plantilla>
    @section('content_header')
    <div class="card redondeado m-1 p-4 shadow bg-degrade">
        <div class="row d-flex justify-content-around">            
            <div class="col">
                <h2 class="fw-bold my-2" style="font-size: 20px">EDITAR {{$gira->nombre}} </h2>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                        class="fas fa-arrow-left mr-1"></i>Regresar</a>
            </div>
        </div>
    </div>
    @stop

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary redondeado shadow">
                <div class="card-header redondeado-card">
                    <h3 class="card-title">Datos de Gira</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="form-group">
                        <label for="nombre">Nombre de Gira</label>
                        <input type="text" id="nombre" value="{{$gira->nombre}}" class="form-control" required>
                        <input type="hidden" id="id_gira" value="{{$gira->id}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea id="descripcion" class="form-control" rows="4">{{$gira->descripcion}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Estado</label>
                        <select id="estado" class="form-control custom-select" required>
                            <option value="{{strtoupper($gira->estado)}}">{{ucfirst(strtolower($gira->estado))}}</option>
                            @foreach ($estados as $estado )
                                @if (strtoupper($gira->estado) != strtoupper($estado))
                                    <option value="{{strtoupper($estado)}}">{{$estado}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary w-100" id="btn-editar">EDITAR</button>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-info redondeado shadow">
                <div class="card-header redondeado-card">
                    <h3 class="card-title">Fases de Gira</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- the events -->
                    <div id="sortable">
                        @foreach ($etapas as $etapa)
                            <div id="{{$etapa->id}}" class="external-event {{$etapa->color}}">{{$etapa->nombre}} <div class="float-right">
                                <a class="delete" href="#" style="color: #fff"><i class="fas fa-trash"></i></a></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-info redondeado shadow">
                <div class="card-header redondeado-card">
                    <h3 class="card-title">Crear Fase</h3>
                </div>
                <div class="card-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-secondary" href="#"><i class="fas fa-square"></i></a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                        <input id="nombre_fase" type="text" class="form-control" placeholder="Nombre de nueva fase">

                        <div class="input-group-append">
                            <button id="btn-crear-fase" type="button" class="btn btn-primary">ADD</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
            integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(function() {
                $("#sortable").sortable();
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $(document).ready(function() {
                $('#color-chooser a').click(function(e) {
                    let color = $(this).attr('class');
                    color = color.split('-');
                    color[0] = color[0].replace('text', 'btn');
                    color = color[0] + '-' + color[1];
                    $('#btn-crear-fase').attr('class', 'btn ' + color);
                })
                $('#btn-crear-fase').click(function(e) {
                    let color = $(this).attr('class');
                    color = color.split('-')
                    color = color[1];
                    if ($('#nombre_fase').val() != '') {
                        $('#sortable').append(
                            '<div id="" class="external-event bg-' + color + '">' + $('#nombre_fase').val() +
                            ' <div class="float-right"><a class="delete" href="#" style="color: #fff"><i class="fas fa-trash"></i></a></div></div>'
                        )
                    }
                })
                $(document).on('click','#sortable .delete',function (){
                    let id = $(this).parents().parents().attr('id');
                    let elemento = $(this).parents().parents();
                    let data = {
                        id:id,
                    }
                    if (id != '') {
                        $.post({
                            url: '{{route("etapa.validacionClientes")}}',
                            data: data,
                            success: function(response) {
                                if (response == 0) {
                                    elemento = elemento[0];
                                    elemento.remove();
                                }else{
                                    Swal.fire({
                                        title:'NO se puede borrar Etapa !',
                                        text:'Tienes '+response+' clientes registrado en la etapa, debes de moverlos para poder eliminar la etapa actual',
                                        icon:'error',
                                        confirmButtonColor: '#d33',
                                    })
                                }
                            }
                        })
                    }else{
                        elemento = elemento[0];
                        elemento.remove();
                    }


                })
            });
            $(document).on('click','#btn-editar',function (e) {
                let etapas = [];
                let elemento = $('#sortable .external-event');
                $.each(elemento,function (i,v) {
                    let nombre = $(this).text().trim()
                    let color = $(this).attr('class')
                    let id = $(this).attr('id');
                    color = color.split(' ')
                    color = color[1]
                    etapas.push([nombre,color,id])
                })
                data = {
                    id:$('#id_gira').val(),
                    nombre:$('#nombre').val(),
                    descripcion:$('#descripcion').val(),
                    estado:$('#estado').val(),
                    etapas:etapas,
                }

                $.post({
                        url: '{{route("edit.gira")}}',
                        data: data,
                        success: function(response) {
                            window.location="{{redirect()->back()->getTargetUrl()}}?edit=true";
                        }
                    })
            })

        </script>
    @endpush
</x-plantilla>
