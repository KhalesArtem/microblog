@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Manage Categories!1</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-primary">View</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;">
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
