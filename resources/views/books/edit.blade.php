@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2 class="mb-0">Edit Book</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.books.edit', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Book Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $book->name) }}"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($book->image)
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <div>
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                                    class="img-thumbnail" width="150">
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">
                            Replace Image
                        </label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $book->price) }}"
                            class="form-control @error('price') is-invalid @enderror">

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stocks" class="form-label">Stocks</label>
                        <input type="number" name="stocks" id="stocks" value="{{ old('stocks', $book->stocks) }}"
                            class="form-control @error('stocks') is-invalid @enderror">

                        @error('stocks')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" name="available" id="available" value="1" class="form-check-input"
                            {{ old('available', $book->available) ? 'checked' : '' }}>

                        <label class="form-check-label" for="available">
                            Available
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Update Book
                        </button>

                        <a href="{{ route('admin.books') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
