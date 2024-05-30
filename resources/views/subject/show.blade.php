@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Subject') }}: {{ $subject->name }}</div>

                    <div class="card-body">
                        <p>{{ $subject->description }}</p>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('subject.post.create', $subject->id) }}" class="btn btn-primary mb-3">Create New Post</a>
                        @endif

                        {{-- Display Linked Classifications --}}
                        <div class="mb-3">
                            <h5>Classifications:</h5>
                            <ul class="list-unstyled">
                                @foreach($subject->classes as $class)
                                    <li>
                                        <a href="{{ route('activity.show', $class) }}">
                                            {{ $class->name }} (Rating: {{ $class->rating ?? 'N/A' }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @foreach ($posts as $post)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('subject.post.show', [$subject->id, $post->id]) }}">{{ $post->title }}</a></h5>
                                    <p class="text-muted">Created by: {{ $post->user->name }}</p>
                                    <p class="text-muted">Content: {{ Str::limit($post->content, 100) }}</p>

                                    <p class="text-muted">Last reply:
                                        @if($post->latestReply)
                                            {{ $post->latestReply->created_at->diffForHumans() }}
                                        @else
                                            No replies yet
                                        @endif
                                    </p>

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
