<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
           body {
                font-family: 'Open Sans', sans-serif;
            } 
        </style>
    </head>
    <body class="bg-gray-200">
        <div id="app" class="flex flex-wrap justify-center p-8">
            @yield('content')
            <portal-target name="modals"></portal-target>
        </div>
    </body>
</html>
