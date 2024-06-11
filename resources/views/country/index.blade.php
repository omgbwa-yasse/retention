@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">{{ __('Countries') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('country.create') }}"
                               class="btn btn-primary mb-3">{{ __('New Country') }}</a>
                        @endif

                        @foreach ($Countries as $country)
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0"><a href="{{ route('country.show', $country->id) }}">{{ $country->name }}</a></h5>
                                        <p class="text-muted">Abbreviation: {{ $country->abbr }}</p>

                                        @if(auth()->check())
                                            <a href="{{ route('country.edit', $country->id) }}" class="btn btn-secondary btn-sm">{{ __('Edit') }}</a>

                                            <form action="{{ route('country.destroy', $country->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __("Are you sure you want to delete this country?") }}')">{{ __('Delete') }}</button>
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
