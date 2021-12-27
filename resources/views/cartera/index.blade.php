<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Cartera de Clientes</h2>
            </div>
            <div class="col my-auto text-right">
            </div>
        </div>
    @stop

    <div class="container">
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
                        <button type="submit" class="btn btn-primary">Cargar productos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-plantilla>