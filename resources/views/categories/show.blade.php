@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">{{ $category->name }}</h1>

        <form action="{{ route('category.show', $category) }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="sort_by" class="form-control">
                        <option value="created_at" {{ $sortField === 'created_at' ? 'selected' : '' }}>Сортировать по дате</option>
                        <option value="title" {{ $sortField === 'title' ? 'selected' : '' }}>Сортировать по названию</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort_direction" class="form-control">
                        <option value="asc" {{ $sortDirection === 'asc' ? 'selected' : '' }}>По возрастанию</option>
                        <option value="desc" {{ $sortDirection === 'desc' ? 'selected' : '' }}>По убыванию</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" placeholder="Дата начала">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" placeholder="Дата окончания">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Фильтровать</button>
        </form>

        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->excerpt }}</p>
                            <a href="{{ route('blog.show', $blog) }}" class="btn btn-primary">Читать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
