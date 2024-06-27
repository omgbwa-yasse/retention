@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Catégories de Référence') }}</div>
                    <form action="{{ route('reference_categories.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('reference_categories.create') }}" class="btn btn-primary mb-3">Nouvelle Catégorie de Référence</a>
                        @endif

                        @foreach ($referenceCategories as $referenceCategory)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('reference_categories.show', $referenceCategory->id) }}">{{ $referenceCategory->name }}</a></h5>
                                    <p class="text-muted">Description : {{ $referenceCategory->description }}</p>

                                    @if(auth()->check())
                                        <a href="{{ route('reference_categories.edit', $referenceCategory->id) }}" class="btn btn-secondary btn-sm">{{ __('Modifier') }}</a>

                                        <form action="{{ route('reference_categories.destroy', $referenceCategory->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __("Êtes-vous sûr de vouloir supprimer cette catégorie de référence?") }}')">{{ __('Supprimer') }}</button>
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
