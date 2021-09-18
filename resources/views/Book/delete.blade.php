<br>
<h4>Delete this book</h4>
<form action="{{ route('delete_book', ['book_id' => $book_id])) }}" method="GET">
    @method('DELETE')
    @csrf
    <button name="submit" class="btn btn-danger">Delete</button>
</form>
