@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <p>Category: {{ $product->category->name }}</p>
    <a href="{{ route('categories.show', $product->category) }}" class="btn btn-secondary">Back to Category</a>
</div>
@endsection
