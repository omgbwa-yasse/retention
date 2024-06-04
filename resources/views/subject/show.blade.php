@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                       <H1> {{ __('Subject') }}:  {{ $subject->name }}</H1>

                        @if (auth()->check() && auth()->user()->id === $subject->user_id && $subject->created_at->diffInMinutes(now()) <= 30)
                            <div class="btn-group">
                                <a href="{{ route('subject.edit', $subject) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('subject.destroy', $subject) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <p>{{ $subject->description }}</p>

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
                        <hr>
                        @if(auth()->check())
                            <a href="{{ route('subject.post.create', [$subject->id]) }}" class="btn btn-primary mb-3">Create New Post</a>
                        @endif

                        @foreach ($posts as $post)
                            <div class="post-container mb-4">
                                <div class="media">
                                    <div class="media-body">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mt-0">
                                                {{--                                                <a href="{{ route('subject.post.showPost', [$subject->id, $post->id]) }}">--}}
                                                <b>   {{ $post->name }}</b>
                                                {{--                                                </a>--}}
                                            </h5>
                                            @if (auth()->check() && auth()->user()->id === $post->user_id && $post->created_at->diffInMinutes(now()) <= 30)
                                                <div class="btn-group">
                                                    <a href="{{ route('subject.post.editPost', [$subject, $post]) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('subject.post.destroyPost', [$subject, $post]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <p>{{ $post->content }}</p>
                                        <p class="text-muted">Created by: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>

                                        {{-- Reactions --}}
                                        <div class="d-flex align-items-center">
                                            @if(auth()->check())
                                                <form action="{{ route('reaction.add', ['post' => $post->id]) }}" method="POST" class="me-2">
                                                    @csrf
                                                    <input type="hidden" name="reaction_type_id" value="1">
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                                        Like ({{ $post->forumReactionPosts->where('reaction_type_id', 1)->count() }})
                                                    </button>
                                                </form>
                                                <form action="{{ route('reaction.add', ['post' => $post->id]) }}" method="POST" class="me-2">
                                                    @csrf
                                                    <input type="hidden" name="reaction_type_id" value="2">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Dislike ({{ $post->forumReactionPosts->where('reaction_type_id', 2)->count() }})
                                                    </button>
                                                </form>

                                                {{-- Reply Button --}}

                                                <button class="btn btn-sm btn-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#replies-{{ $post->id }}">
                                                    Replies ({{ $post->children->count() }})
                                                </button>
                                                <a href="#" class="btn btn-sm btn-secondary" onclick="toggleReplyForm({{ $post->id }})">Reply</a>
                                            @endif
                                        </div>

                                        {{-- Replies --}}
                                        <div class="collapse mt-2" id="replies-{{ $post->id }}">
                                            @foreach ($post->children as $reply)
                                                <div class="card card-body mt-2">
                                                    <h5 class="mb-0">Titre :{{ $reply->name }}</h5>
                                                    <hr>

                                                    <p> {{ $reply->content }}</p>
                                                    <p class="text-muted"> {{ $reply->created_at->diffForHumans() }}</p>
                                                    <h6 class="mb-0">Ecrit par {{ $reply->user->name }}</h6>

                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Reply Form --}}

                                        @if(auth()->check())
                                            <div id="replyForm-{{ $post->id }}" class="mt-2" style="display:none;">
                                                <form action="{{ route('subject.post.reply', [$subject->id, $post->id]) }}" method="POST">
                                                    @csrf
                                                    <input id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" placeholder="Title">
                                                    <textarea name="content" class="form-control mb-2" placeholder="Your reply..."></textarea>
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit Reply</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleReplyForm(postId) {
            var replyForm = document.getElementById("replyForm-" + postId);
            if (replyForm.style.display === "none" || replyForm.style.display === "") {
                replyForm.style.display = "block";
            } else {
                replyForm.style.display = "none";
            }
        }
        function toggleReplyForm1(postId) {
            var replyForm = document.getElementById("replyForm-" + postId);
            if (replyForm.style.display === "none" || replyForm.style.display === "") {
                replyForm.style.display = "block";
            } else {
                replyForm.style.display = "none";
            }
        }
    </script>

@endsection

