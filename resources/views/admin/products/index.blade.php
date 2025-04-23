@extends('layouts.app')

@section('content')
<a href="{{ route('admin.adminHome') }}">Back</a>
<h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create New Product</a>
    <ul>
        @foreach ($products as $product)
            <li>
                <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
