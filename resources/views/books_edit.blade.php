<x-Layout>
    
    <x-slot name="title">books</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Books</h1>
    <hr>
    <p class="content">
        
        @include('Book.add')
        @include('Book.delete')
        
        <hr>
        <br>
    </p>

</x-Layout>  