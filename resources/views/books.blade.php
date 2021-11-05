<x-Layout>

    <x-slot name="title">books</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Books</h1>
    <hr>
    <p class="content">
        @if ( Session::get("failed") )
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endif

        @if (isset($books))
            @foreach ($books as $book)
                <div class="bookContainer">
                    <img src="{{ 'storage/'.$book->cover }}" class="img-fluid" alt="Book Picture">
                    <h2>{{ $book->title }}</h2>
                    <p>{!! str_replace("\\","<br>",$book->descriptions) !!}</p>
                    <a href="{{ $book->url }}" target="blank" >Click to See book page</a>
                </div>
            @endforeach
        @endif
    </p>

</x-Layout>
