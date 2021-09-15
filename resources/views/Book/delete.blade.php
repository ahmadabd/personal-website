<br>
<h4>Delete this book</h4>
<form action="" method="GET">
    @method('DELETE')
    @csrf
    <button name="delete" class="btn btn-danger">Delete</button>
</form>