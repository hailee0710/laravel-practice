@extends('layouts.app')

@section('content')
<a href="{{ route('admin.categories.index') }}">Back</a>
    <h1>Create New Category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection

