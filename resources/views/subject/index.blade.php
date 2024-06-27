@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Forum') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('subject.create') }}" class="btn btn-primary mb-3">Nouveau Sujet </a>
                        @endif

                        @foreach ($subjects as $subject)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('subject.show', $subject->id) }}">{{ $subject->name }}</a></h5>
                                    <p class="text-muted">Creer Par: {{ $subject->user->name }}</p>
                                    <p class="text-muted">Description: {{ $subject->description }}</p>

                                    <p class="text-muted">Derniere Publication:
                                        @if($subject->latestPost)
                                            {{ $subject->latestPost->created_at->diffForHumans() }}
                                        @else
                                            Pas encore de Publication !
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
