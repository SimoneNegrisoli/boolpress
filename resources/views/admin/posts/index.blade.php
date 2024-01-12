@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Post list</h1>
        @foreach ($posts as $item)
            <p><a href="{{ route('admin.posts.show', $item->id) }}">
                    {{ $item->title }}
                </a></p>
        @endforeach
    </section>
@endsection
