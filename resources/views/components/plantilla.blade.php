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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
<<<<<<< HEAD
        window.Echo.channel('events').listen('RealTimeMessage', (e) => {
            console.log('RealTimeMessage: ' + e.message)
        });        
=======
        window.Echo.channel('events').listen('RealTimeMessage', (e) => {           
            Push.create("Tienes un Recordatorio:", {
                body: e.message,
                // icon: '/icon.png',
                timeout: 4000,
                onClick: function () {
                    window.focus();
                    this.close();
                }
            });
        });
>>>>>>> edaa85de4009c4f6dd7c7330594df0ceff002541
    </script>
    @livewireScripts()
@stop
