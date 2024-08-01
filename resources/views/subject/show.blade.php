@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="mb-0"><strong>{{ __('Sujet') }}: {{ $subject->name }}</strong></h1>
                        @if (auth()->check() && auth()->user()->id === $subject->user_id && $subject->created_at->diffInMinutes(now()) <= 30)
                            <div class="btn-group">
                                <a href="{{ route('subject.edit', $subject) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit me-1"></i>Modifier
                                </a>
                                <form action="{{ route('subject.destroy', $subject) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="fas fa-trash-alt me-1"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <p class="lead">{{ $subject->description }}</p>

                        <div class="mb-4">
                            <h5><i class="fas fa-tags me-2"></i>Classifications:</h5>
                            <ul class="list-inline">
                                @foreach($subject->classes as $class)
                                    <li class="list-inline-item">
                                        <a href="{{ route('activity.show', $class) }}" class="btn btn-outline-secondary btn-sm">
                                            {{ $class->name }}
                                            <span class="badge bg-info">Note : {{ $class->rating ?? 'N/A' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <hr>

                        @if(auth()->check())
                            <a href="{{ route('subject.post.create', [$subject->id]) }}" class="btn btn-primary mb-4">
                                <i class="fas fa-plus-circle me-2"></i>Créer un nouveau message
                            </a>
                        @endif

                        @foreach ($posts as $post)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-0"><strong>{{ $post->name }}</strong></h4>
                                        @if (auth()->check() && auth()->user()->id === $post->user_id && $post->created_at->diffInMinutes(now()) <= 30)
                                            <div class="btn-group">
                                                <a href="{{ route('subject.post.editPost', [$subject, $post]) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit me-1"></i>Modifier
                                                </a>
                                                <form action="{{ route('subject.post.destroyPost', [$subject, $post]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                                        <i class="fas fa-trash-alt me-1"></i>Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <p class="text-muted">
                                        <small>
                                            <i class="fas fa-user me-2"></i>Créé par : {{ $post->user->name }} |
                                            <i class="fas fa-clock me-2"></i>{{ $post->created_at->diffForHumans() }}
                                        </small>
                                    </p>

                                    @if(auth()->check())
                                        <div class="d-flex align-items-center mb-3">
                                            <form action="{{ route('reaction.add', ['post' => $post->id]) }}" method="POST" class="me-2">
                                                @csrf
                                                <input type="hidden" name="reaction_type_id" value="1">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-thumbs-up me-1"></i>J'aime ({{ $post->forumReactionPosts->where('reaction_type_id', 1)->count() }})
                                                </button>
                                            </form>
                                            <form action="{{ route('reaction.add', ['post' => $post->id]) }}" method="POST" class="me-2">
                                                @csrf
                                                <input type="hidden" name="reaction_type_id" value="2">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-thumbs-down me-1"></i>Je n'aime pas ({{ $post->forumReactionPosts->where('reaction_type_id', 2)->count() }})
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#replies-{{ $post->id }}">
                                                <i class="fas fa-comments me-1"></i>Réponses ({{ $post->children->count() }})
                                            </button>
                                            <a href="#" class="btn btn-sm btn-secondary" onclick="toggleReplyForm({{ $post->id }})">
                                                <i class="fas fa-reply me-1"></i>Répondre
                                            </a>
                                        </div>
                                    @endif

                                    <div class="collapse mt-3" id="replies-{{ $post->id }}">
                                        @foreach ($post->children as $reply)
                                            <div class="card card-body mt-2">
                                                <h5 class="mb-2">{{ $reply->name }}</h5>
                                                <p>{{ $reply->content }}</p>
                                                <p class="text-muted mb-0">
                                                    <small>
                                                        <i class="fas fa-user me-2"></i>{{ $reply->user->name }} |
                                                        <i class="fas fa-clock me-2"></i>{{ $reply->created_at->diffForHumans() }}
                                                    </small>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if(auth()->check())
                                        <div id="replyForm-{{ $post->id }}" class="mt-3" style="display:none;">
                                            <form action="{{ route('subject.post.reply', [$subject->id, $post->id]) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Titre">
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="content" class="form-control" placeholder="Votre réponse..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane me-2"></i>Envoyer la réponse
                                                </button>
                                            </form>
                                        </div>
                                    @endif
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
    </script>
@endsection
