<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <div id="app">
            <event-component></event-component>
        </div>



        </div>
    </body>
</html>
