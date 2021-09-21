<x-Layout>

    <x-slot name="title">books</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Books</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @elseif( Session::get("failed") )
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endif

        @foreach ($books as $book)
            <div class="bookContainer">
                @include('Book.update', ['book' => $book])
                @include('Book.delete', ['book' => $book])
            </div>
        @endforeach

        @include('Book.add')
        <br>
    </p>

</x-Layout>
