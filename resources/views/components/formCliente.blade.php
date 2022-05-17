<div class="card shadow redondeado {{ $edit ? '' : 'd-none' }}">
    <div class="card-header bg-success redondeado-card">
        <h3 class="card-title">Editar Cliente</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="minimizar">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" wire:click="$set('edit',false)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @if( $edit )
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>RUC</label>
                        <input type="text" class="form-control" wire:model="ruc" placeholder="Ingresar el ruc del cliente">
                    </div>
                    <div class="form-group">
                        <label>EMAIL</label>
                        <input type="email" class="form-control" wire:model="email" placeholder="Ingresar el email del cliente">
                    </div>
                    <div class="form-group">
                        <label>PROVINCIA</label>
                        <select class="form-control" wire:model='provincia'>
                            <option value="{{$provincia}}">{{$provincia}}</option>
                                @foreach ($provincias as $val)
                                @if ($provincia !=$val->descripcion)                                    
                                    <option value="{{$val->descripcion}}">{{$val->descripcion}}</option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>NOMBRE</label>
                        <input type="text" class="form-control" wire:model="nombre" placeholder="Ingresar el nombre del cliente">
                    </div>
                    <div class="form-group">
                        <label>TELÉFONO</label>
                        <input type="number" class="form-control" wire:model="telefono" placeholder="Ingresar el teléfono del cliente" >
                    </div>
                    <div class="form-group">
                        <label>CIUDAD</label>
                        <select class="form-control" wire:model.defer="ciudad">
                            <option>{{$ciudad}}</option>
                            @foreach ($ciudades as $val)
                                @if ($ciudad !=$val->descripcion)                                    
                                    <option value="{{$val->descripcion}}">{{$val->descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card-footer text-right">
        <button class="btn btn-secondary mr-2" wire:click="$set('edit',false)">CANCELAR</button>
        <button class="btn btn-primary" wire:click="save()">GUARDAR</button>
    </div>
</div>
