<x-Layout>
    
    <x-slot name="title">Contact Me</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Contact Me</h1>
    <hr>
    <div class="content">
        @isset($availableContactLinks)
            @foreach ($availableContactLinks as $contactLink)
                <p class="icons">{{ svg($contactLink[0]) }}</p>
                <p class="iconUrl">{{ $contactLink[1] }}</p>
                <br>
            @endforeach
        @endisset

        @empty($availableContactLinks)
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endempty
    </div>

</x-Layout>    