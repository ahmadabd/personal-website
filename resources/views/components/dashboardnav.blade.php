<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-radius: 5px">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Get Picture from Database -->
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('change_profilePic') }}">
                    <img class="profilePic" src="{{ $profilePicture }}" alt="" width="100" height="100">
                    <h6>Click to change</h6>
                </a>
            </div>
        </nav>

        <a class="navbar-brand profileName {{ (request()->routeIs('change_profileName')) ? 'active' : '' }}" href="{{ route('change_profileName') }}">{{ $profileName }}</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('edit_biography')) ? 'active' : '' }}" aria-current="page" href="{{ route('edit_biography') }}">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('show_contactMe_edit')) ? 'active' : '' }}" aria-current="page" href="{{ route('show_contactMe_edit') }}">Contact Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('resume_editPage')) ? 'active' : '' }}" aria-current="page" href="{{ route('resume_editPage') }}">CV</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('weblog_edit')) ? 'active' : '' }}" aria-current="page" href="{{ route('weblog_edit') }}">weblog</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ (request()->routeIs('book_editPage')) ? 'active' : '' }}" aria-current="page" href="{{ route('book_editPage') }}">Books</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('logout') }}">logout</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
