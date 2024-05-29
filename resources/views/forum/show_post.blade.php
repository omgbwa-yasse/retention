@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->name }}</div>
                    <div class="card-body">
                        <p class="text-muted">Created by: {{ $post->user->name }}</p>
                        <p class="text-muted">Created at: {{ $post->created_at }}</p>
                        <p>{!! $post->content !!}</p>
                        @if(auth()->check())
                            <a href="{{ route('forum.createPost', $post->id) }}" class="btn btn-primary mb-3">Create New Reply</a>


                        @endif
                        @foreach($replies as $reply)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $reply->name }}</h5>
                                    <p class="text-muted">Created by: {{ $reply->user->name }}</p>
                                    <p class="text-muted">Created at: {{ $reply->created_at }}</p>
                                    <p>{!! $reply->content !!}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        {{ $replies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
