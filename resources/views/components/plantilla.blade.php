@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    {{ $slot }}
@stop

@section('css')
    <link rel="stylesheet" href="{{url('css/notifications.scss')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles()
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
        // window.Echo.channel('events').listen('RealTimeMessage', (e) => {
        //     Push.create("Tienes un Recordatorio:", {
        //         body: e.message,
        //         // icon: '/icon.png',
        //         onClick: function () {
        //             window.focus();
        //         }
        //     });
        // });
        $(document).on('click','.notify',function(e){
            let id = $(this).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.get({
                url: "{{url('leerNotificacion')}}/"+id,
                success: function(response) {
                    if (response.trim() == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Recordatorio Leido'
                        })
                    }
                }
            })
        })
    </script>
    @livewireScripts()
@stop
