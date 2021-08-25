<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Layout Page Css -->
        <link rel="stylesheet" href="/css/layout.css">

        <!-- Other Page Css -->
        <link rel="stylesheet" href="/css/{{ $page_css }}">

    </head>
    <body>

        @auth
            <x-Dashboardnav />
        @else
            <x-Nav />                
        @endauth

        <div class="container-fluid">
            <div class="container">
                <div class="row block">
                    <div class="col"></div>
                    <div class="col-6">
                        {{ $slot }}
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </body>
</html>
    