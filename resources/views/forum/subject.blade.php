@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Subject: ') }} {{ $subject->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $subject->name }}</h5>
                                <p class="text-muted">Created by: {{ $subject->user->name }}</p>
                                <p class="text-muted">Description: {{ $subject->description }}</p>
                            </div>
                        </div>

                        @if(auth()->check())

                                <a href="{{ route('forum.createPost', ['subject' => $subject->id]) }}" class="btn btn-primary mb-3">Create New Post</a>

                            @endif

                            @foreach ($posts as $post)
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0"><a href="{{ route('forum.showPost', $post->id) }}"> {{ $post->name }}</a></h5>
                                        <p class="text-muted">Created by: {{ $post->user->name }}</p>
                                        <p class="text-muted">Created at: {{ $post->created_at }}</p>
                                        <p class="mb-1">{{ Str::limit($post->content, 200) }}</p>

                                        @if ($post->replies()->count() > 0)
                                            <a href="{{ route('forum.showPost', $post->id) }}">View {{ $post->replies()->count() }} replies</a>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            {{ $posts->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
