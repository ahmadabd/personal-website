<x-Layout>
    
    <x-slot name="title">Change profile Picture</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Profile Picture</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @error('profilePic')
            <div class="alert alert-danger">{{ $message }}</div>
            <br>       
        @enderror

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @endif

        <form action="{{ route('store_profilePic') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="profilePic">Upload Profile Picture:(100x100 px)|(Max size: 10 MB)</label>
            <input type="file" class="form-control" id="profilePic" name="profilePic" required />
            <br>
            <button name="submit" class="btn btn-success">upload</button>
        </form>
    </p>

</x-Layout>    