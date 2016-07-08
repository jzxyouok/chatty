<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="{{URL::to('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ URL::to('bootstrap/css/main.css') }}">
        <script src="{{ URL::to('bootstrap/js/jquery-1.10.2.js') }}"></script>
        <script src="{{ URL::to('bootstrap/js/bootstrap.min.js') }}"></script>

        <title>@yield('title')</title>
    </head>
    <body>
        @include('templates.partials.navigation')
        <div class="container">
            @include('templates.partials.alert')
            @yield('content')
        </div>
    </body>
</html>