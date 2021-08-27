<x-Layout>
    
    <x-slot name="title">Add new resume</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Add your new resume</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @error('resumeFile')
            <div class="alert alert-danger">{{ $message }}</div>
            <br>       
        @enderror

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @endif

        <form action="{{ route('store_resume') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="resumeFile">Upload Your New Resume (pdf)|(Max size: 10MB):</label>
            <input type="file" class="form-control" id="resumeFile" name="resumeFile" required />
            <br>
            <button name="submit" class="btn btn-success">upload</button>
        </form>
    </p>

</x-Layout>    