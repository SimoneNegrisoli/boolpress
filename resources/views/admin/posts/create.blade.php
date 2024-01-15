@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Post create</h1>
        <form action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required maxlength="200" minlength="3" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="body">body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" maxlength="200"
                    minlength="3" value="{{ old('body') }}">
                </textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image">image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" required maxlength="200" minlength="3" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <button type="submit">invia</button>
            <button type="reset">reset</button>

        </form>
    </section>
@endsection
