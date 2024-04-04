@extends('layouts.app')

@section('content')
    <h1>Список категорий</h1>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <a href="{{ route('category.show', $category) }}" class="btn btn-primary">Посмотреть блоги</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
