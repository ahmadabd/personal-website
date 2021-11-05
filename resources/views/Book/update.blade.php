<form action="{{ route('update_book', [ 'book' => $book->id ]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <h4>Book: {{ $book->title }}</h4>
    <div class="form-group">
        <label for="title">Title</label>
        <input value="{{ $book->title }}" type="text" name="title" class="form-control" id="title" placeholder="Title ..." required />
        <br>
        <label for="descriptions">Description</label>
        <textarea name="descriptions" class="form-control" id="descriptions" rows="20" placeholder="End each line with: \" required>{{ $book->descriptions }}</textarea>
        <br>
        <label for="url">Book Url Address</label>
        <input value="{{ $book->url }}" type="text" name="url" id="url" class="form-control" placeholder="http://..." required>
        <br>
        <label class="form-label" for="book_picture">Upload Books Picture:(800x600 px)|(Max size: 10 MB)</label>
        <input type="file" class="form-control" id="book_picture" name="book_picture" />
    </div>

    <button name="submit" class="btn btn-success">Update</button>
</form>
