@extends('index')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('latest_news') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">
            @foreach($news as $item)
                <div class="list-group-item list-group-item-action flex-column align-items-start mt-5">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                        <small class="text-muted">
                            {{ __('created_at') }}: {{ $item->created_at->format('d F Y') }}
                        </small>
                    </div>
                    <p class="mb-1">{{ $item->description }}</p>
                    <small class="text-muted">
                        <i class="bi bi-person-fill"></i> {{ __('posted_by') }} {{ $item->user->name }}
                    </small>
                </div>
            @endforeach
        </div>
    </div>
@endsection
