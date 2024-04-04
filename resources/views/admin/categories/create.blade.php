@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <h1>Create Category</h1>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="blogs" class="form-label">Select Blogs</label>
                    <select multiple class="form-control" id="blogs" name="blogs[]">
                        @foreach($blogs as $blog)
                            <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>
@endsection
