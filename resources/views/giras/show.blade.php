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
                <button class="btn btn-primary btn-sm js-offcanvas-trigger" data-offcanvas-trigger="off-canvas-right"><i
                        class="fas fa-plus mr-1"></i>Agregar
                    Cliente</button>
            </div>



        </div>
    @stop

    @push('css')

        <link href="https://unpkg.com/js-offcanvas@1.2.8/dist/_css/prefixed/js-offcanvas.css" rel="stylesheet">
        <style>
            .breadcrumb {
                display: inline-block;
                padding: 0;
                margin: 0;
                background: transparent;
                overflow: hidden;
            }

            .breadcrumb li {
                float: left;
                padding: 8px 15px 8px 25px;
                background: #fdec82;
                font-size: 16px;
                font-weight: bold;
                color: #777;
                position: relative;
            }

            /* 
                                        .breadcrumb li:first-child {
                                            background: #fdf9cc;
                                        }

                                        .breadcrumb li:last-child {
                                            background: #fddc05;
                                            margin-right: 18px;
                                        } */

            .breadcrumb li:before {
                display: none;
            }

            .breadcrumb li:after {
                content: "";
                display: block;
                border-left: 20px solid #fdec82;
                border-top: 20px solid transparent;
                border-bottom: 20px solid transparent;
                position: absolute;
                top: 0;
                right: -20px;
                z-index: 1;
                -webkit-filter: drop-shadow(1px 0px 0px rgba(0, 0, 0, .5));
                filter: drop-shadow(1px 0px 0px rgba(0, 0, 0, .5));
            }

            .breadcrumb li.bg-primary:after {
                border-left: 20px solid #007BFF;
            }

            .breadcrumb li.bg-secondary:after {
                border-left: 20px solid #6C757D;
            }

            .breadcrumb li.bg-info:after {
                border-left: 20px solid #17A2B8;
            }

            .breadcrumb li.bg-warning:after {
                border-left: 20px solid #FFC107;
            }

            .breadcrumb li.bg-danger:after {
                border-left: 20px solid #DC3545;
            }

            .breadcrumb li.bg-success:after {
                border-left: 20px solid #28A745;
            }



            .breadcrumb li a {
                font-size: 16px;
                font-weight: bold;
                color: #777;
            }

            @media only screen and (max-width: 479px) {
                .breadcrumb li {
                    padding: 8px 15px 8px 30px;
                }
            }

        </style>
    @endpush

    <div class="container">
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
                                                    <th>Teléfono</th>
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
    </div>

    <!--Right-->
    <aside class="js-offcanvas js-open" data-offcanvas-options='{"modifiers":"right,overlay"}' id="off-canvas-right"
        role="complementary">
        <div class="row">
            <div class="col">
                <h3>Agregar cliente</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary js-offcanvas-close"
            data-button-options='{"modifiers":"blue,hard,close-right"}'>Close</button>
    </aside>

    @push('js')
        <script src="https://unpkg.com/js-offcanvas@1.2.8/dist/_js/js-offcanvas.pkgd.min.js"></script>
        <script>
            $(document).ready(function() {

                $(document).trigger("enhance");
            });
        </script>
    @endpush

</x-plantilla>
