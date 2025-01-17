@extends('index')

@section('content')
    <div class="container-fluid py-4 bg-light">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <!-- En-tête du sujet -->
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-primary text-white p-4 rounded-top">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="mb-2"><strong>{{ __('Sujet') }}: {{ $subject->name }}</strong></h1>
                                <p class="lead mb-3">{{ $subject->description }}</p>

                                <!-- Boutons de partage -->
                                <div class="share-buttons d-flex align-items-center gap-2">
                                <span class="text-white me-2">
                                    <i class="fas fa-share-alt me-1"></i>Partager:
                                </span>
                                    <button class="btn btn-light btn-sm" onclick="shareURL('whatsapp')" title="Partager sur WhatsApp">
                                        <i class="fab fa-whatsapp text-success"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm" onclick="shareURL('facebook')" title="Partager sur Facebook">
                                        <i class="fab fa-facebook text-primary"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm" onclick="shareURL('twitter')" title="Partager sur Twitter">
                                        <i class="fab fa-twitter text-info"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm" onclick="shareURL('linkedin')" title="Partager sur LinkedIn">
                                        <i class="fab fa-linkedin text-primary"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm" onclick="copyToClipboard()" title="Copier le lien">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                            @if (auth()->check() && auth()->user()->id === $subject->user_id && $subject->created_at->diffInMinutes(now()) <= 30)
                                <div class="btn-group">
                                    <a href="{{ route('subject.edit', $subject) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Modifier
                                    </a>
                                    <form action="{{ route('subject.destroy', $subject) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                            <i class="fas fa-trash-alt me-2"></i>Supprimer
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="d-flex align-items-center mb-3">
                                <i class="fas fa-tags me-2 text-primary"></i>Classifications:
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($subject->classes as $class)
                                    <a href="{{ route('activity.show', $class) }}"
                                       class="btn btn-outline-primary btn-sm rounded-pill">
                                        {{ $class->name }}
                                        <span class="badge bg-primary ms-2">Note : {{ $class->rating ?? 'N/A' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @if(auth()->check())
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                                <a href="{{ route('subject.post.create', [$subject->id]) }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus-circle me-2"></i>Nouveau message
                                </a>
                            </div>
                        @endif

                        <!-- Zone des messages -->
                        <div class="messages-container">
                            @foreach ($posts as $post)
                                <div class="card shadow-sm mb-4 message-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary text-white p-3 me-3">
                                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h4 class="mb-1"><strong>{{ $post->name }}</strong></h4>
                                                    <p class="text-muted mb-0">
                                                        <i class="fas fa-user me-2"></i>{{ $post->user->name }}
                                                        <span class="mx-2">•</span>
                                                        <i class="fas fa-clock me-2"></i>{{ $post->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                            @if (auth()->check() && auth()->user()->id === $post->user_id && $post->created_at->diffInMinutes(now()) <= 30)
                                                <div class="btn-group">
                                                    <a href="{{ route('subject.post.editPost', [$subject, $post]) }}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit me-1"></i>Modifier
                                                    </a>
                                                    <form action="{{ route('subject.post.destroyPost', [$subject, $post]) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                                            <i class="fas fa-trash-alt me-1"></i>Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="message-content mb-4">
                                            {{ $post->content }}
                                        </div>

                                        @if(auth()->check())
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <form action="{{ route('reaction.add', ['post' => $post->id]) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="reaction_type_id" value="1">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="fas fa-thumbs-up me-2"></i>
                                                        <span class="badge bg-primary">{{ $post->forumReactionPosts->where('reaction_type_id', 1)->count() }}</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('reaction.add', ['post' => $post->id]) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="reaction_type_id" value="2">
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="fas fa-thumbs-down me-2"></i>
                                                        <span class="badge bg-danger">{{ $post->forumReactionPosts->where('reaction_type_id', 2)->count() }}</span>
                                                    </button>
                                                </form>
                                                <button class="btn btn-outline-secondary"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#replies-{{ $post->id }}">
                                                    <i class="fas fa-comments me-2"></i>
                                                    Réponses ({{ $post->children->count() }})
                                                </button>
                                                <button class="btn btn-primary"
                                                        onclick="toggleReplyForm({{ $post->id }})">
                                                    <i class="fas fa-reply me-2"></i>Répondre
                                                </button>
                                            </div>
                                        @endif

                                        <!-- Réponses -->
                                        <div class="collapse show" id="replies-{{ $post->id }}">
                                            <div class="ms-4 ps-3 border-start">
                                                @foreach ($post->children as $reply)
                                                    <div class="card bg-light mb-3 border-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $reply->name }}</h5>
                                                            <p class="card-text">{{ $reply->content }}</p>
                                                            <div class="d-flex align-items-center text-muted">
                                                                <i class="fas fa-user-circle me-2"></i>
                                                                {{ $reply->user->name }}
                                                                <span class="mx-2">•</span>
                                                                <i class="fas fa-clock me-2"></i>
                                                                {{ $reply->created_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Formulaire de réponse -->
                                        @if(auth()->check())
                                            <div id="replyForm-{{ $post->id }}" class="mt-3" style="display:none;">
                                                <form action="{{ route('subject.post.reply', [$subject->id, $post->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <input type="text"
                                                               class="form-control"
                                                               name="name"
                                                               placeholder="Titre de votre réponse"
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                    <textarea name="content"
                                                              class="form-control"
                                                              rows="3"
                                                              placeholder="Votre réponse..."
                                                              required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-paper-plane me-2"></i>Envoyer
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
    </div>

    <style>
        .message-card {
            transition: transform 0.2s ease-in-out;
            border-radius: 1rem;
        }

        .message-card:hover {
            transform: translateY(-2px);
        }

        .message-content {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .messages-container {
            max-height: 800px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .rounded-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .share-buttons .btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .share-buttons .btn:hover {
            transform: translateY(-2px);
        }

        .toast {
            border-radius: 10px;
        }
    </style>

    <script>
        function toggleReplyForm(postId) {
            const replyForm = document.getElementById(`replyForm-${postId}`);
            if (replyForm) {
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
            }
        }

        function shareURL(platform) {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent("{{ $subject->name }}");
            const description = encodeURIComponent("{{ $subject->description }}");

            let shareUrl = '';

            switch(platform) {
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${title}&url=${url}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                // Créer une notification toast
                const toast = document.createElement('div');
                toast.className = 'position-fixed bottom-0 end-0 p-3';
                toast.style.zIndex = '11';
                toast.innerHTML = `
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i>Lien copié avec succès!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

                document.body.appendChild(toast);
                const toastElement = toast.querySelector('.toast');
                const bsToast = new bootstrap.Toast(toastElement, { delay: 2000 });
                bsToast.show();

                // Supprimer l'élément après l'animation
                toastElement.addEventListener('hidden.bs.toast', () => {
                    toast.remove();
                });
            }).catch(err => {
                console.error('Erreur lors de la copie:', err);
            });
            // Gestion de l'affichage des réponses
            document.addEventListener('DOMContentLoaded', function() {
                // Initialiser les tooltips Bootstrap
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Initialiser les toasts Bootstrap
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl);
                });

                // Scroll automatique vers le message si spécifié dans l'URL
                const urlParams = new URLSearchParams(window.location.search);
                const messageId = urlParams.get('message');
                if (messageId) {
                    const messageElement = document.getElementById(`message-${messageId}`);
                    if (messageElement) {
                        messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        messageElement.classList.add('highlight');
                        setTimeout(() => {
                            messageElement.classList.remove('highlight');
                        }, 3000);
                    }
                }

                // Gérer le clic sur "Voir plus de réponses"
                document.querySelectorAll('.show-more-replies').forEach(button => {
                    button.addEventListener('click', function() {
                        const repliesContainer = this.closest('.replies-container');
                        repliesContainer.querySelector('.hidden-replies').classList.remove('d-none');
                        this.classList.add('d-none');
                    });
                });
            });

            // Animation du formulaire de réponse
            function animateReplyForm(form) {
                form.style.opacity = '0';
                form.style.display = 'block';
                setTimeout(() => {
                    form.style.opacity = '1';
                }, 10);
            }}
    </script>

    <style>
        /* Styles supplémentaires pour améliorer l'interface */
        .highlight {
            animation: highlight 3s ease-out;
        }

        @keyframes highlight {
            0% { background-color: rgba(var(--bs-primary-rgb), 0.2); }
            100% { background-color: transparent; }
        }

        .message-card {
            transition: all 0.3s ease;
        }

        .message-card:hover .message-actions {
            opacity: 1;
        }

        .message-actions {
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .replies-container {
            position: relative;
            padding-left: 2rem;
        }

        .replies-container::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--bs-primary);
            opacity: 0.2;
        }

        .avatar-container {
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 50%;
            background-color: var(--bs-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(var(--bs-primary-rgb), 0.1);
        }

        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        .reply-transition {
            transition: all 0.3s ease-in-out;
        }

        .hidden-replies {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .hidden-replies.show {
            max-height: 1000px;
        }

        /* Styles pour les formulaires */
        .reply-form {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .reply-form.show {
            opacity: 1;
        }

        /* Styles pour le défilement */
        .messages-container::-webkit-scrollbar {
            width: 8px;
        }

        .messages-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .messages-container::-webkit-scrollbar-thumb {
            background: var(--bs-primary);
            border-radius: 4px;
        }

        .messages-container::-webkit-scrollbar-thumb:hover {
            background: var(--bs-primary-darker);
        }

        /* Styles pour les toasts */
        .toast {
            min-width: 200px;
        }

        .toast-container {
            z-index: 1060;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .message-card {
                margin-left: 0;
                margin-right: 0;
            }

            .share-buttons {
                flex-wrap: wrap;
            }

            .message-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .replies-container {
                padding-left: 1rem;
            }
        }

        /* Animations pour les nouveaux messages */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .new-message {
            animation: slideIn 0.3s ease-out;
        }
    </style>
@endsection
