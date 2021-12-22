<div>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Reportes</h2>
            </div>
            <div class="col my-auto text-right">
            </div>
        </div>
    @stop
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="cmb_user">Vendedor</label>
                            <select class="custom-select" id="cmb_user">
                                <option value="">Seleccionar vendedor</option>
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
                                @foreach ($gira as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="txt_cliente">Cliente</label>
                            <input id="txt_cliente" class="form-control" type="text"
                                placeholder="Escriba el nombre o RUC del cliente">
                            <input type="hidden" id="id_cliente">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="txt_fecha">Fecha de gira:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="txt_fecha">
                            </div>
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
                <table class="table table-striped projects text-center" id="reports">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>CLIENTE</th>
                            <th>TIPO GESTION</th>
                            <th>GIRA</th>
                            <th>ETAPA</th>
                            <th>VENDEDOR</th>
                            <th>GESTION</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />
    @endpush

    @push('js')
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
        <script>
            let espanol = {
                "sProcessing": '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div>',
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            let dataTable = $('#reports').DataTable({

                "destroy": true,
                "processing": true,
                "columns": [{
                        "data": "created_at",
                        "render": function(data, type, row) {
                            let fecha = data.split('T');
                            return fecha[0];
                        }
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "tipo_gestion",
                    },
                    {
                        "data": "nombre_gira",
                    },
                    {
                        "data": "nombre_etapa",
                    },
                    {
                        "data": "nombre_usuario",
                    },
                    {
                        "data": 'comentario',
                    }

                ],
                "lengthMenu": [
                    [-1, 10, 25, 50],
                    ["Todos", 10, 25, 50]
                ],
                "order": [
                    [0, 'desc']
                ],
                "language": espanol,
                //para usar los botones
                "responsive": false,
                "autoWidth": false,
                "dom": 'Bfrtilp',
                "buttons": [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        pageSize: 'TABLOID',
                        orientation: 'landscape'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        exportOptions: {
                            stripHtml: false
                        }
                    },
                ]
            });
            if (dataTable.length == 0) {
                dataTable.clear();
                dataTable.draw();
            }

            $(document).ready(function() {
                $('#txt_fecha').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                });
                $('#txt_fecha').val('');

                let path = "{{ route('web.autocompletar') }}";

                $('#txt_cliente').autocomplete({
                    source: function(request, response) {
                        $.getJSON(path, {
                                term: request.term
                            },
                            response
                        );
                    },
                    focus: function(event, ui) {
                        $("#txt_cliente").val(ui.item.value);
                        return false;
                    },
                    minLength: 1,
                    select: function(event, ui) {
                        $('#id_cliente').val(ui.item.id);
                    }
                }).autocomplete("instance")._renderItem = function(ul, item) {
                    if (item.value) {
                        return $("<li>").append("<div><span>" + item.ruc + "</span><br><span>" + item.value +
                                "</span></div>")
                            .appendTo(ul);
                    } else {
                        return $("<li class='ui-state-disabled'>").append("<div>Cliente no encontrado</div>")
                            .appendTo(ul);
                    }

                };

                $('#btn_buscar').on('click', function() {
                    let txt_fecha = $('#txt_fecha').val();
                    let fecha_desde = '';
                    let fecha_hasta = '';
                    let arrFecha = [];
                    if(txt_fecha.length > 1){
                        arrFecha = txt_fecha.split(' - ');
                    }
                    if (arrFecha.length > 1) {
                        fecha_desde = arrFecha[0];
                        fecha_hasta = arrFecha[1];
                    }
                    let data = {
                        'id_usuario': $('#cmb_user').val(),
                        'id_gira': $('#cmb_gira').val(),
                        'id_cliente': $('#id_cliente').val(),
                        'fecha_desde': fecha_desde,
                        'fecha_hasta': fecha_hasta,
                    }
                    $.post({
                        url: '{{ route('fase.dataTable') }}',
                        data: data,
                        beforeSend: function() {},
                        success: function(response) {
                            console.log(JSON.parse(response));
                            dataTable.clear().draw();
                            dataTable.rows.add(JSON.parse(response)).draw();
                        }
                    });
                });
            });



            function limpiar() {
                $('#txt_fecha').val('');
                $('#txt_cliente').val('');
                $('#cmb_user').val('');
                $('#cmb_gira').val('');
            }
        </script>
    @endpush
</div>
