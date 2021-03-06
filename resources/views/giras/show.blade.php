<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">{{ $gira->nombre }}</h2>
            </div>
            <div class="col my-auto text-right">
                {{-- <a class="btn btn-primary btn-sm" href="#offCanvas" id="triggerButton"><i class="fas fa-plus mr-1"></i>Agregar
                    Cliente</a> --}}
                <button class="btn btn-primary btn-sm offcanvas-trigger"><i class="fas fa-plus mr-1"></i>Agregar
                    Cliente</button>
            </div>



        </div>
    @stop

    @push('css')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-offcanvas@3.4.7/dist/jquery.offcanvas.min.css">

    @endpush

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $gira->nombre }}</h3>
            </div>
            <div class="card-body text-center p-0">
                <div class="row p-2">
                    <div class="col">
                        <ol class="breadcrumb">
                            @foreach ($etapas as $etapa)
                                <li class="{{ $etapa->color }}"><a data-toggle="collapse"
                                        href="#card{{ $etapa->id }}">{{ $etapa->nombre }}</a>
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
                                <div id="card{{ $etapa->id }}" class="collapse" data-parent="#accordion"
                                    style="">
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">&nbsp;</th>
                                                    <th style="width: 10px">#</th>
                                                    <th>Asignado a</th>
                                                    <th>Zona</th>
                                                    <th>Nombre</th>
                                                    <th>Etapa</th>
                                                    <th>Tel??fono</th>
                                                    <th>RUC</th>
                                                    <th>Notas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="{{ route('fase.historial') }}"
                                                            class="btn btn-sm btn-info"><i
                                                                class="fas fa-edit"></i></a>
                                                    </td>
                                                    <td><input type="checkbox" name="prueba" id="prueba"></td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger"
                                                                style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">55%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><button class="btn btn-sm btn-info"><i
                                                                class="fas fa-edit"></i></button></td>
                                                    <td><input type="checkbox" name="prueba" id="prueba"></td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger"
                                                                style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">55%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><button class="btn btn-sm btn-info"><i
                                                                class="fas fa-edit"></i></button></td>
                                                    <td><input type="checkbox" name="prueba" id="prueba"></td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger"
                                                                style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">55%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><button class="btn btn-sm btn-info"><i
                                                                class="fas fa-edit"></i></button></td>
                                                    <td><input type="checkbox" name="prueba" id="prueba"></td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger"
                                                                style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">55%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><button class="btn btn-sm btn-info"><i
                                                                class="fas fa-edit"></i></button></td>
                                                    <td><input type="checkbox" name="prueba" id="prueba"></td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger"
                                                                style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">55%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>
            <!-- /.card-body -->
        </div>


    <div id="element" data-offcanvas-duration="200" data-offcanvas-easing="ease" class="p-2" style="overflow-y: scroll; height: 100vh">
        <div class="row" style="padding-top: 57px">
            <div class="col">
                <h5>Agregar cliente</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group input-group-sm">
                    <input id="txt_search" class="form-control form-control-divbar" type="text"
                        placeholder="Buscar cliente" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-1">
            <div class="col">
                <div class="list-group" id="myList" role="tablist">
                    @foreach ($clientes as $cliente)
                        <a class="list-group-item list-group-item-action p-2" href="#home" role="tab"><button
                                class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button><span
                                class="pl-2">{{ $cliente->nombre }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/2.0.6/velocity.min.js"
                integrity="sha512-+VS2+Nl1Qit71a/lbncmVsWOZ0BmPDkopw5sXAS2W+OfeceCEd9OGTQWjgVgP5QaMV4ddqOIW9XLW7UVFzkMAw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-offcanvas@3.4.7/dist/jquery.offcanvas.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                var $el = $("#element").offcanvas({
                    effect: "slide-in-over",
                    overlay: true,
                    origin: "right",
                    coverage: "400px",
                });

                var styles = {
                    backgroundColor: "#fff",                    
                };

                $(".offcanvas-element").css(styles);

                $(".offcanvas-trigger").on("click.offcanvas", function() {
                    $el.offcanvas("show");
                });

                $("#txt_search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myList a").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                // let path = "{{ route('web.autocompletar') }}";

                // $('#txt_search').autocomplete({
                //     source: function(request, response) {
                //         $.getJSON(path, {
                //                 term: request.term
                //             },
                //             response
                //         );
                //     },
                //     focus: function(event, ui) {
                //         $("#txt_search").val(ui.item.value);
                //         return false;
                //     },
                //     minLength: 1,
                //     open: function(event, ui) {
                //         $(this).autocomplete("widget").css({
                //             "width": "auto"
                //         });
                //     },
                //     select: function(event, ui) {
                //         //  url = url.replace(':id', ui.item.estilo);
                //         //  document.location.href = url;
                //         //get_datos_afiliado(ui.item.data);
                //         //console.log('You selected: ' + ui.item.value + ', ' + ui.item.data);
                //     }
                // }).autocomplete("instance")._renderItem = function(ul, item) {
                //     if (item.value) {
                //         return $("<li>").append("<div><span>" + item.ruc + "</span><br><span>" + item.value +
                //                 "</span></div>")
                //             .appendTo(ul);
                //     } else {
                //         return $("<li class='ui-state-disabled'>").append("<div>Cliente no encontrado</div>")
                //             .appendTo(ul);
                //     }

                // };
            });
        </script>
    @endpush

</x-plantilla>
