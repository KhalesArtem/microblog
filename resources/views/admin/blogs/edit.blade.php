@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Edit Blog</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ $blog->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select class="form-control" id="categories" name="categories[]" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($blog->categories->contains($category)) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Selected Categories</label>
                    <table class="table table-striped">
                        <tbody>
                        @foreach ($blog->categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('admin.blogs.removeCategoryFromBlog', ['blog' => $blog, 'category' => $category]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
