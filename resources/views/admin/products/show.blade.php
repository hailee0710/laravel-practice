@extends('layouts.app')

@section('content')
<a href="{{ route('admin.products.index') }}">Back</a>
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <p>Category: <a href="{{ route('admin.categories.show', $product->category->id) }}">{{ $product->category->name }}</a></p>
    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back to Products</a>
@endsection
