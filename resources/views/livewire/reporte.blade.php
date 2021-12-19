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
            </div>
            <div class="card-body">
                <table class="table table-striped projects text-center" id="reports">
                    <thead>
                        <tr>
                            <th colspan="4">{{ $usuario->nombre_usuario }}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>CLIENTE</th>
                            <th>TIPO</th>
                            <th>GESTION</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('js')
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
                "ajax": {
                    "url": "{{ route('fase.dataTable') }}",
                    "method": "POST",
                    "dataSrc": function(json) {
                        if (json == 'no data') {
                            return [];
                        } else {
                            return json;
                        }
                    },
                },
                "columns": [
                    {
                        "data": "created_at",
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "tipo",
                    },
                    {
                        "data": 'comentario',
                    }

                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todo"]
                ],
                // "columnDefs": [{
                //         "targets": [3],
                //         "orderable": false,
                //         "searchable": false
                //     },
                //     //{ "width": "1%", "targets": 0 }
                // ],
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
        </script>
    @endpush
</div>
