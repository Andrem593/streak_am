@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    {{ $slot }}
@stop

@section('css')
    <link rel="stylesheet" href="{{url('css/notifications.scss')}}">
    @livewireStyles()
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.Echo.channel('events').listen('RealTimeMessage', (e) => {           
            Push.create("Tienes un Recordatorio:", {
                body: e.message,
                // icon: '/icon.png',
                onClick: function () {
                    window.focus();
                }
            });
        });
    </script>
    @livewireScripts()
@stop
