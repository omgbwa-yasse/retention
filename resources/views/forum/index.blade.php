@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Forum') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('forum.createSubject') }}" class="btn btn-primary mb-3">Create New Subject</a>
                        @endif

                        @foreach ($subjects as $subject)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('forum.subject', $subject->id) }}">{{ $subject->name }}</a></h5>
                                    <p class="text-muted">Created by: {{ $subject->user->name }}</p>
                                    <p class="text-muted">Description: {{ $subject->description }}</p>


                                    <p class="text-muted">Last post: @if($subject->posts()->latest()->first()) {{ $subject->posts()->latest()->first()->created_at->diffForHumans() }} @else No posts yet @endif</p>

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
