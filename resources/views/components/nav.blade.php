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