@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">View Category</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
