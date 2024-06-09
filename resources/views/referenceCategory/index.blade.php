@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Reference Categories') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('reference_categories.create') }}" class="btn btn-primary mb-3">New Reference Category</a>
                        @endif

                        @foreach ($referenceCategories as $referenceCategory)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('reference_categories.show', $referenceCategory->id) }}">{{ $referenceCategory->name }}</a></h5>
                                    <p class="text-muted">Description: {{ $referenceCategory->description }}</p>
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
