@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post') }}: {{ $post->title }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('subject.post.create', [$subject->id, $post->id]) }}" class="btn btn-primary mb-3">Create New Reply</a>
                        @endif

                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $post->title }}</h5>
                                <p class="text-muted">Created by: {{ $post->user->name }}</p>
                                <p class="text-muted">Content: {{ $post->content }}</p>
                            </div>
                        </div>

                        @foreach ($replies as $reply)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $reply->title }}</h5>
                                    <p class="text-muted">Created by: {{ $reply->user->name }}</p>
                                    <p class="text-muted">Content: {{ $reply->content }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
