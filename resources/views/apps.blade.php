<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">-->
        <title>{{ config('app.name', 'DM Test') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="{{ mix('css/apps/style.css') }}" rel="stylesheet" />
        
          <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
          </script>

    </head>
    <body>
        <div id="app" >

        </div>
        
        <script src="{{ mix('js/apps/app.js') }}"></script>      
    </body>
</html>
