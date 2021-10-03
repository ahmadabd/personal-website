<x-Layout>

    <x-slot name="title">Change weblog</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Add your weblog url</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors -->
        @isset($errors)
            @error('weblog_address')
                <div class="alert alert-danger">{{ $message }}</div>
                <br>
            @enderror
        @endisset

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @elseif( Session::get("failed") )
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endif

        <form action="{{ route('store_weblog') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="weblog_address">Add your weblog url</label>
            <input type="text" placeholder="https://..." class="form-control" value="{{ $lastWeblogUrl }}" id="weblog_address" name="weblog_address" />
            <br>
            <button name="submit" class="btn btn-success">store</button>
        </form>
    </p>

</x-Layout>
