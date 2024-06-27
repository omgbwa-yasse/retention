@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">{{ __('Catégories de typologie') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->check())
                            <a href="{{ route('typology_categories.create') }}" class="btn btn-primary mb-3">{{ __('Nouvelle catégorie de typologie') }}</a>
                        @endif

                        @foreach ($typologyCategories as $typologyCategory)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('typology_categories.show', $typologyCategory->id) }}">{{ $typologyCategory->name }}</a></h5>
                                    <p class="text-muted">Description : {{ $typologyCategory->description }}</p>
                                    <p class="text-muted">Catégorie parente : @if($typologyCategory->parent) {{ $typologyCategory->parent->name }} @else {{ __('Aucune catégorie parente') }} @endif</p>

                                    @if(auth()->check())
                                        <a href="{{ route('typology_categories.edit', $typologyCategory->id) }}" class="btn btn-secondary btn-sm">{{ __('Modifier') }}</a>

                                        <form action="{{ route('typology_categories.destroy', $typologyCategory->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __("Êtes-vous sûr de vouloir supprimer cette catégorie de typologie ?") }}')">{{ __('Supprimer') }}</button>
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
