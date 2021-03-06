<div class="w-100">
    @if ($paginator->hasPages())
        <nav class="d-flex justify-content-between w-100">
            <div class="my-auto">                
                    <p class="text-info">
                        <span>{!! __('Mostrando de') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('a') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('de') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('resultados') !!}</span>
                    </p>
            </div>
            <ul class="pagination">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item">
                            <button dusk="previousPage{{ $paginator->getCursorName() == 'page' ? '' : '.' . $paginator->getPageName() }}" type="button" class="page-link" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" rel="prev">@lang('pagination.previous')</button>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev">@lang('pagination.previous')</button>
                        </li>
                    @endif
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item">
                            <button dusk="nextPage{{ $paginator->getCursorName() == 'page' ? '' : '.' . $paginator->getPageName() }}" type="button" class="page-link" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" rel="next">@lang('pagination.next')</button>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next">@lang('pagination.next')</button>
                        </li>
                    @endif
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
