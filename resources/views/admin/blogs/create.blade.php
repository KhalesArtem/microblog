@extends('layouts.app')

@section('title', 'Create Blog')

@section('content')
    <h1>Create Blog</h1>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('admin.blogs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select multiple class="form-control" id="categories" name="categories[]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Blog</button>
            </form>
        </div>
    </div>
@endsection
