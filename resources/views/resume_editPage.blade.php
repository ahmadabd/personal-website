<x-Layout>
    
    <x-slot name="title">Add new resume</x-slot>
    <x-slot name="page_css"></x-slot>

    <!-- Flash Messages -->
    @if ( Session::get("success") )
        <p class="alert alert-success">{{ Session::get("success") }}</p>
        <hr>
    @endif
    
    <p class="content">
        <div>
            <h1 class="title">Add your new resume</h1>

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
            

            <form action="{{ route('store_resume') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="form-label" for="resumeFile">Upload Your New Resume (pdf)|(Max size: 10MB):</label>
                <input type="file" class="form-control" id="resumeFile" name="resumeFile" required />
                <br>
                <button name="submit" class="btn btn-success">upload</button>
            </form>
        </div>

        <br>
        <hr>
        <br>

        @if ($resume != "")
            <div>
                <h3 class="title">Delete old resume</h3>
                <p>if dont want to have resume to show, press Delete.</p>
                <form action="{{ route('delete_resume') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button name="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endif
    </p>

</x-Layout>    