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

                                        @if(auth()->check())
                                            <a href="{{ route('reference_categories.edit', $referenceCategory->id) }}" class="btn btn-secondary btn-sm">{{ __('Edit') }}</a>

                                            <form action="{{ route('reference_categories.destroy', $referenceCategory->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __("Are you sure you want to delete this reference category?") }}')">{{ __('Delete') }}</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <hr>

                                <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
