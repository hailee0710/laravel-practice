@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <div class="row">
        @foreach ($category->products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
