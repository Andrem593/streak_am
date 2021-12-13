@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    {{ $slot }}
@stop

@section('css')
    @livewireStyles()
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Echo.channel('events').listen('RealTimeMessage', (e) => {
            console.log('RealTimeMessage: ' + e.message)
        });        
    </script>
    @livewireScripts()
@stop
