<x-Layout>
    
    <x-slot name="title">About Me</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Biography</h1>
    <hr>
    <p class="content">
        @isset($bio)
            {!! str_replace("\\","<br>",$bio) !!}
        @endisset

        @empty($bio)
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endempty
    </p>

</x-Layout>    