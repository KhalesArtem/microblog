@extends('layouts.app')

@section('title', 'Manage Blogs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Manage Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create Blog</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @foreach ($blog->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
