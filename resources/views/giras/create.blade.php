<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Modulo de Giras Streak</h2>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-secondary btn-sm" href="{{ route('giras') }}"><i class="fas fa-arrow-left mr-1"></i>Regresar</a>
            </div>
        </div>
    @stop
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear Gira</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="nombre">Nombre de Gira</label>
                            <input type="text" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea id="descripcion" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Estado</label>
                            <select id="inputStatus" class="form-control custom-select">
                                <option selected="" disabled="">Selecciona</option>
                                <option>Activa</option>
                                <option>Inactiva</option>
                                <option>Cancelada</option>
                                <option>Completada</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
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
                            <div class="external-event bg-success">B/D CLIENTES <div class="float-right"><a class="delete" href="#" style="color: #fff"><i class="fas fa-trash"></i></a></div></div>
                            <div class="external-event bg-warning">POR VISITAR <div class="float-right"><a class="delete" href="#" style="color: #fff"><i class="fas fa-trash"></i></a></div></div>
                            <div class="external-event bg-info">POR LLAMAR <div class="float-right"><a class="delete" href="#" style="color: #fff" ><i class="fas fa-trash"></i></a></div></div>
                            <div class="external-event bg-primary">VISITAS <div class="float-right"><a class="delete" href="#" style="color: #fff" ><i class="fas fa-trash"></i></a></div></div>
                            <div class="external-event bg-danger">LLAMADAS <div class="float-right"><a class="delete" href="#" style="color: #fff" ><i class="fas fa-trash"></i></a></div></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-info">
                    <div class="card-header">
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
    </div>
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $( function() {
                $( "#sortable" ).sortable();
            } );            
        </script>
        <script>
            $('#color-chooser a').click(function (e) {
                let color = $(this).attr('class');
                color = color.split('-');
                color[0] = color[0].replace('text','btn');
                color = color[0]+'-'+color[1];                
                $('#btn-crear-fase').attr('class', 'btn '+color);
            })
            $('#btn-crear-fase').click(function (e) {
                let color = $(this).attr('class');
                color = color.split('-')
                color = color[1];                            
                if($('#nombre_fase').val() != ''){
                    $('#sortable').append(
                        '<div class="external-event bg-'+color+'">'+$('#nombre_fase').val()+' <div class="float-right"><a class="delete" href="#" style="color: #fff"><i class="fas fa-trash"></i></a></div></div>'
                    )
                }
            })
        </script>
    @endpush
</x-plantilla>
