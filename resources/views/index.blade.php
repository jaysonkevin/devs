<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Software</title>

    </head>
    <body>
       
       <div id="app">
            <router-view></router-view>
           
       </div>
       <div id="modals"></div>
      
      
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
