<br>
<form action="{{ route('delete_book', [ $book->id ]) }}" method="POST">
    @method('DELETE')
    @csrf
    <button name="submit" class="btn btn-danger">Delete</button>
</form>
