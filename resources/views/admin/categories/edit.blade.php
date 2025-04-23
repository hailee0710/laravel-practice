@extends('layouts.app')

@section('content')
<a href="{{ route('admin.categories.index') }}">Back</a>
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $category->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection
