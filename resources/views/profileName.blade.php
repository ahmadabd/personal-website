<x-Layout>
    
    <x-slot name="title">Change profile Name</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Profile Name</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @error('profileName')
            <div class="alert alert-danger">{{ $message }}</div>
            <br>       
        @enderror

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @endif

        <form action="{{ route('store_profileName') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="profileName">Write your biography</label>
                <input name="profileName" value="{{ $profileName }}" class="form-control" id="profileName" required />
            </div>

            <button name="submit" class="btn btn-success">save</button>
        </form>
    </p>

</x-Layout>    