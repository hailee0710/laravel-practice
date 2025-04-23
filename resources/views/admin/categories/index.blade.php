@extends('layouts.app')

@section('content')
<a href="{{ route('admin.adminHome') }}">Back</a>
<h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create New Category</a>
    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
