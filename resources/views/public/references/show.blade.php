<!-- resources/views/public/references/show.blade.php -->
@extends('index')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $reference->name }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $reference->description }}</p>
            <p><strong>Category:</strong> {{ $reference->category->name }}</p>
            <p><strong>Country:</strong> {{ $reference->country->name }}</p>

            <h2 class="mt-4">Articles</h2>
            <ul class="list-group">
                @foreach($reference->articles as $article)
                    <li class="list-group-item">{{ $article->name }}</li>
                @endforeach
            </ul>

            <h2 class="mt-4">Files</h2>
            <ul class="list-group">
                @foreach($reference->files as $file)
                    <li class="list-group-item">
                        <strong>File:</strong> {{ $file->name }}
                        <a href="{{ $file->file_path }}" class="btn btn-primary btn-sm" target="_blank">View File</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
