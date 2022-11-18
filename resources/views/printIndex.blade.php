

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRM</title>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/dashboard.css" rel="stylesheet">
<!--        <link href="/css/style.css?version={{config('global.version')}}" rel="stylesheet">-->
        @yield('css')
    </head>
    <body>
        @yield('content')
    </body>
    
</html


