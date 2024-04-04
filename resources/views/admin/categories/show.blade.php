@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container">
        <div class="mb-3">
            <h1>Edit Category: {{ $category->name }}</h1>
        </div>

        <!-- Форма для изменения названия категории -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Edit Category Name</h5>
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Blogs in this Category</h5>
                @if($category->blogs->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category->blogs as $blog)
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->created_at->format('M d, Y H:i:s') }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.removeBlog', ['category' => $category, 'blog' => $blog]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this blog from the category?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No blogs found in this category.</p>
                @endif
            </div>
        </div>

        <!-- Форма для добавления блога к этой категории -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add a Blog to this Category</h5>
                <form action="{{ route('admin.categories.addBlog', $category->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="blog_id" class="form-label">Select Blog</label>
                        <select name="blog_id" id="blog_id" class="form-control">
                            @foreach($availableBlogs as $blog)
                                <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                </form>
            </div>
        </div>
    </div>
@endsection
