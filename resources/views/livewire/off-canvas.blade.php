<div>
    {{-- elemento a mostrar boton abrir off canvas --}}
    <button class="btn btn-primary btn-sm offcanvas-trigger" wire:click="$set('open',true)"><i
            class="fas fa-user-plus"></i></button>
    {{-- elemento off canvas --}}
    <div id="canvas" class="offcavas shadow {{ $open == true ? 'move-to-init' : 'move-to-left' }}">
        <div class="offcanvas-header p-3 border-bottom shadow-sm">
            <div class="row">
                <div class="col-8">
                    <span class="text-muted" style="font-size: 12px">STREAK</span>
                    <h5 class="fw-bolder text-secondary">Agregar Clientes</h5>
                </div>
                <div class="col my-auto">
                    <div class="float-right">
                        <button type="button" wire:click="$set('open',false)" class="close closeCanvas"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="offcanvas-body p-2">
            <div class="row">
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input id="txt_search" wire:model="buscar" class="form-control form-control-divbar"
                            type="search" placeholder="Buscar cliente" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-1" style="overflow-y: scroll; height: 100vh;">
                <div class="col">
                    <div class="list-group" id="myList" role="tablist">
                        @empty(!$clientes)
                            @foreach ($clientes as $cliente)
                                <a class="list-group-item list-group-item-action p-2" role="tab">
                                    <button class="btn btn-sm btn-primary" wire:loading.attr="disabled"
                                        wire:click="addCliente({{ $cliente->id_cliente }})"><i
                                            class="fas fa-plus"></i></button><span
                                        class="pl-2">{{ $cliente->nombre }}</span></a>
                            @endforeach
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- overley con funciones de click para desaparecer --}}
    <div id="overley" class="{{ $open == true ? '' : 'd-none' }}" wire:click="$set('open',false)"
        style="width: 100%;height: 100%;">

    </div>
</div>
