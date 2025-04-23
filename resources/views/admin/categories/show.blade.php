@extends('layouts.app')

@section('content')
<a href="{{ route('admin.categories.index') }}">Back</a>
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back to Categories</a>
@endsection
