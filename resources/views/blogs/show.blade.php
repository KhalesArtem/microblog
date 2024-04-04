@extends('layouts.app')

@section('content')
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>

    <h3>Категории1:</h3>
    <ul>
        @foreach($categories as $category)
            <li><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
@endsection
