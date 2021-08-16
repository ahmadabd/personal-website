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

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-radius: 5px">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Get Picture from Database -->
                <nav class="navbar navbar-light bg-light">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img class="profilePic" src="pics/profile.jpg" alt="" width="100" height="100">
                        </a>
                    </div>
                </nav>
                
                <!-- Get name from Database -->
                <a class="navbar-brand profileName" href="{{ route('about') }}">Ahmad Abdollahzadeh</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <div class="container">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">   
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->routeIs('about')) ? 'active' : '' }}" aria-current="page" href="{{ route('about') }}">About Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->routeIs('contact')) ? 'active' : '' }}" aria-current="page" href="{{ route('contact') }}">Contact Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{ route('cv') }}">CV</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{ route('weblog') }}">Weblog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

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
    