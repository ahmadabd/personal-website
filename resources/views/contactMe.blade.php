<x-Layout>
    
    <x-slot name="title">Contact Me</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Contact Me</h1>
    <hr>
    <div class="content">
        @isset($contactLinks)
            @foreach ($contactLinks as $link)
                <p class="icons">{{ svg($link[0]) }}</p>
                <p class="iconUrl">{{ $link[1] }}</p>
                <br>
            @endforeach
        @endisset

        @empty($contactLinks)
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endempty
    </div>

</x-Layout>    