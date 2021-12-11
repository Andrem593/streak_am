@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    {{$slot}}
@stop

@section('css')
    @livewireStyles()
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('390affdc5a516a9894e1', {
        //     cluster: 'us2'
        // });
        // var channel = pusher.subscribe('my-channel');
        //     channel.bind('my-event', function(data) {
        //         alert(JSON.stringify(data));
        //     });

        window.Echo.channel('events').listen('RealTimeMessage', (e) => {
            console.log('RealTimeMessage: ' + e.message)
        });
    </script>
    @livewireScripts()
@stop