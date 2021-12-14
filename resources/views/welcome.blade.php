<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>socket</h1>

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
        Echo.channel('events').listen('RealTimeMessage', (e) => {
            console.log('RealTimeMessage: ' + message)
        });
    </script>
</body>
</html>