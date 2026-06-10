@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row g-4 justify-content-center">
        <div class="col-md-3 col-sm-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h1 class="display-5 fw-bold">{{ $available_books}}</h1>
                    <p class="text-muted mb-0">Available Books</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h1 class="display-5 fw-bold">{{ $no_stock_books ?? 0 }}</h1>
                    <p class="text-muted mb-0">Books Out of Stock</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection