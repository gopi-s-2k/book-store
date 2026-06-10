@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Books</h2>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                Add Book
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Stocks</th>
                        <th>Status</th>
                        <th width="250">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->name }}</td>
                            <td>
                                <img src="{{ $book->image_url }}" width="80" class="img-thumbnail">
                            </td>
                            <td>₹{{ $book->price }}</td>
                            <td>{{ $book->stocks }}</td>
                            <td>
                                {{-- @if ($book->available) --}}
                                <span id="book-avail-{{ $book->id }}"
                                    style="display:{{ $book->available ? 'block' : 'none' }}"
                                    class="badge bg-success">Available</span>
                                {{-- @else --}}
                                <span id="book-unavail-{{ $book->id }}"
                                    style="display:{{ $book->available ? 'none' : 'block' }}"
                                    class="badge bg-danger">Unavailable</span>
                                {{-- @endif --}}
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.books.edit', ['book_id' => $book->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>


                                    <button data-id="{{ $book->id }}"
                                        class="toggle-book btn btn-sm {{ $book->available ? 'btn-secondary' : 'btn-success' }}">
                                        {{ $book->available ? 'Unavail' : 'Avail' }}
                                    </button>

                                    <button data-id="{{ $book->id }}" class="delete-book btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '.toggle-book', function() {
            const button = $(this);
            const bookId = button.data('id');

            let url = "{{ route('admin.books.avail', ['book_id' => ':book_id']) }}";
            let newurl = url.replace(":book_id", bookId);


            $.ajax({
                url: newurl,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    if (response.available) {
                        button.text('Unavail');
                        button.removeClass('btn-success');
                        button.addClass('btn-secondary');
                        $(`#book-avail-${bookId}`).show();
                        $(`#book-avail-${bookId}`).css('display', 'block');
                        $(`#book-unavail-${bookId}`).hide();
                    } else {
                        button.text('Avail');
                        button.removeClass('btn-secondary');
                        button.addClass('btn-success');
                        $(`#book-unavail-${bookId}`).show();
                        $(`#book-avail-${bookId}`).hide();
                        $(`#book-unavail-${bookId}`).css('display', 'block');
                    }

                    showToast('Status updated');
                }
            });
        });
        $(document).on('click', '.delete-book', function() {
            const button = $(this);
            const bookId = button.data('id');

            action = confirm('Continue to Delete the book?');
            if(!action){
                return;
            }

            let url = "{{ route('admin.books.delete', ['book_id' => ':book_id']) }}";
            let newurl = url.replace(":book_id", bookId);

            $.ajax({
                url: newurl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        button.closest('tr').remove();
                        showToast('deleed successfully');
                    } else {
                        showToast('Error while deleting the book');
                    }
                }
            });
        });
    </script>
@endsection
