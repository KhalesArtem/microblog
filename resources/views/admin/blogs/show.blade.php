@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <div class="container">
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->content }}</p>

        <h4>Categoriesывавыаыа:</h4>
        <ul>
            @foreach($blog->categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>

        <div class="mt-4">
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary">Edit Blog</a>
            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete Blog</button>
            </form>
        </div>

        <div class="mt-4">
            <h4>Manage Categories</h4>
            <form action="{{ route('admin.blogs.updateCategories', $blog) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="categories" class="form-label">Select Categories</label>
                    <select multiple class="form-control" id="categories" name="categories[]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($blog->categories->contains($category)) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Categories</button>
            </form>
        </div>
    </div>
@endsection
