<x-Layout>
    
    <x-slot name="title">login</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Login</h1>
    <hr>
    
    <form method="POST" action="{{ route('login') }}" class="content" >
        @csrf
    
        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" required autofocus />
        </div>
    
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
        </div>
    
        <!-- button -->
        <div class="mb-3">
            <button class="btn btn-primary">
                Log in
            </button>
            <br> <br>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Forgot your password
                </a>
            @endif
        </div>
    </form>

</x-Layout>  