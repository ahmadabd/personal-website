<x-Layout>
    
    <x-slot name="title">dashboard</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Biography</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @error('biography')
            <div class="alert alert-danger">{{ $message }}</div>
            <br>       
        @enderror

        <form action="{{ route('store_biography') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="bio">Write your biography</label>
                <textarea name="biography" class="form-control" id="bio" rows="8" placeholder="End each line with: \ For example:Im Ahmad Abdollahzade.\">{{ $lastStoredBiography }}</textarea>
            </div>

            <button name="submit" class="btn btn-success">store</button>
        </form>
    </p>

</x-Layout>  