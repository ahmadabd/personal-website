<form action="{{ route('store_book') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <br>
    <h4>Add new book</h4>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="title" placeholder="Title ..." required />
        <br>
        <label for="descriptions">Description</label>
        <textarea name="descriptions" class="form-control" id="descriptions" rows="20" placeholder="End each line with: \" required>{{ old('descriptions') }}</textarea>
        <br>
        <label for="url">Book Url Address</label>
        <input type="text" value="{{ old('url') }}" name="url" id="url" class="form-control" placeholder="http://..." required>
        <br>
        <label class="form-label" for="book_picture">Upload Books Picture:(800x600 px)|(Max size: 10 MB)</label>
        <input type="file" value="{{ old('book_picture') }}" class="form-control" id="book_picture" name="book_picture" required />
    </div>

    <button name="submit" class="btn btn-success">Store</button>
</form>
