<div>
    <button class="btn btn-primary btn-sm offcanvas-trigger" wire:click="$set('open',true)"><i class="fas fa-plus mr-1"></i>Agregar
        Cliente</button>  

    <div id="canvas" class="offcavas shadow {{ $open == true ? 'move-to-init' : 'move-to-left'}}">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Offcanvas right</h5>
            
        </div>
        <div class="offcanvas-body">
            
        </div>
    </div>
    <div id="overley" class="{{ $open == true ? '' : 'd-none'}}" wire:click="$set('open',false)" style="width: 100%;height: 100%;">

    </div>
</div>
