@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2 class="mb-0">Add Book</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.books.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Book Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Book Image</label>
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
                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror">

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stocks" class="form-label">Stocks</label>
                        <input type="number" name="stocks" id="stocks" value="{{ old('stocks') }}"
                            class="form-control @error('stocks') is-invalid @enderror">

                        @error('stocks')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" name="available" id="available" value="1" class="form-check-input"
                            {{ old('available') ? 'checked' : '' }}>

                        <label class="form-check-label" for="available">
                            Available
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save Book
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
