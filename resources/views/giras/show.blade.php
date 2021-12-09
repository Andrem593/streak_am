<x-plantilla>
    @section('content_header')
        <div class="row d-flex justify-content-around">
            <div class="col"></div>
            <div class="col text-center">
                <h2 class="fw-bold my-2">Titulo</h2>
            </div>
            <div class="col my-auto text-right">
                <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-plus mr-1"></i>Agregar Cliente</a>
            </div>
        </div>
    @stop

    @push('css')
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
                <h3 class="card-title">Gira 1</h3>
            </div>
            <div class="card-body text-center p-0">
                <div class="row p-2">
                    <div class="col">
                        <ol class="breadcrumb">
                            <li class="bg-primary"><a data-toggle="collapse" href="#collapseOne">BD/Clientes</a>
                            </li>
                            <li class="bg-secondary"><a data-toggle="collapse" href="#collapseTwo">Por visitar</a>
                            </li>
                            <li class="bg-success"><a data-toggle="collapse" href="#collapseThree">Por llamar</a>
                            </li>
                            <li class="bg-warning"><a data-toggle="collapse" href="#collapseFour">Visitas</a></li>
                            <li class="bg-danger"><a data-toggle="collapse" href="#collapseFive">Llamadas</a></li>
                            <li class="bg-info"><a data-toggle="collapse" href="#collapseSix">Pedidos</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" id="accordion">
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne"
                                aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        BD/Clientes
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
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
                        <div class="card card-secondary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo"
                                aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Por visitar
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                                    ridiculus mus.
                                </div>
                            </div>
                        </div>
                        <div class="card card-success card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Por llamar
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat
                                    massa quis enim.
                                </div>
                            </div>
                        </div>
                        <div class="card card-warning card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Visitas
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                </div>
                            </div>
                        </div>
                        <div class="card card-danger card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Llamadas
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                                    eu pede mollis pretium.
                                </div>
                            </div>
                        </div>
                        <div class="card card-info card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Pedidos
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                    eleifend tellus.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</x-plantilla>
