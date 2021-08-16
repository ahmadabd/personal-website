<x-Layout>
    
    <x-slot name="title">Contact Me</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Contact Me</h1>
    <hr>
    <p class="content">
        @isset($contact)
            {{ $contact }}
        @endisset

        @empty($contact)
            <p class="alert alert-danger">{{ Session::get("failed") }}</p>
        @endempty
    </p>

</x-Layout>    