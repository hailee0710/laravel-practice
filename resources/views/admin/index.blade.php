@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">View Categories</a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create New Category</a>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create New Product</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">View Products</a>
@endsection
