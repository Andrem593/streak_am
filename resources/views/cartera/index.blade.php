<x-plantilla>
    @section('content_header')
    <div class="card redondeado m-1 p-4 shadow bg-degrade">
        <div class="row d-flex justify-content-around">
            <div class="col">
                <h2 class="fw-bold my-2" style="font-size: 20px">Cartera de Clientes</h2>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-warning btn-sm" href="{{ public_path('resources/cartera_clientes.xlsx') }}" target="_blank"><i class="fas fa-file-excel"></i>
                    Plantilla</a>
                    <a class="btn btn-primary btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i
                        class="fas fa-arrow-left mr-1"></i>Regresar</a>
            </div>
        </div>
    </div>
    @stop

    <div class="container">
        @if (!empty(session('mensaje')))
            @if (str_contains(session('mensaje'), 'Error:'))
                <div class="alert alert-danger">
                    <p>{{ session('mensaje') }}</p>
                </div>
            @else
                <div class="alert alert-success">
                    <p>{{ session('mensaje') }}</p>
                </div>
            @endif
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cargar cartera de Clientes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="minimizar">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @section('plugins.BsCustomFileInput', true)
            <div class="card-body">
                <form action="{{ route('fase.cargarExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <x-adminlte-input-file name="excel" class="" igroup-size="sm"
                        label="Carga archivo (.xls, .xlsx)" legend="Seleccionar"
                        placeholder="Escoger un archivo .xls o .xlsx"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                        <x-slot name="prependSlot">
                            <div class="input-group-text btn-ibizza">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary">Cargar cartera</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $('form').submit(function(event) {
                    if ($(this).hasClass('submitted')) {
                        $(this).find(':submit').html('Guardar');
                        $(this).find(':submit').attr("disabled", false);
                        event.preventDefault();
                    } else {
                        $(this).find(':submit').attr("disabled", true);
                        $(this).find(':submit').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando base...'
                            );
                        $(this).addClass('submitted');
                    }
                });
            });
        </script>
    @endpush
</x-plantilla>
