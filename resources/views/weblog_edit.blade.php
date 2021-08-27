<x-Layout>
    
    <x-slot name="title">Change weblog</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Add your weblog url</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @error('weblogUrl')
            <div class="alert alert-success">{{ $message }}</div>
            <br>       
        @enderror

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @endif

        <form action="{{ route('store_weblog') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="weblogUrl">Add your weblog url: (https://...)</label>
            <input type="text" class="form-control" id="weblogUrl" name="weblogUrl" required />
            <br>
            <button name="submit" class="btn btn-success">store</button>
        </form>
    </p>

</x-Layout>    