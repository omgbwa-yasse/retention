@extends('index')

@section('content')
            <div class="container text-center my-4">
                <h1>Trouvez vos délais de conservation !</h1>

                <form method="GET" action="{{ route('search') }}" class="d-flex justify-content-center">
                    <input type="text" name="query" class="form-control me-2" placeholder="Search..." />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            @if($classes->count())
                @foreach($classes as $class)
                <div class="list-group mb-3">
                    <div class="list-group-item">
                        <h2 class="fw-bold">{{ $class->name }}</h2>
                        <p class="mb-1">{{ $class->description }}</p>
                        <p class="mb-0">
                        @if( $class->parent)
                                Voir aussi : {{ $class->parent->name ?? "" }}
                            @endif
                        </p>
                        <small class="text-muted">{{ $class->country->name }} ({{ $class->country->abbr }}), créé le {{ $class->created_at }} par {{ $class->user->name }} </small>
                    </div>
                </div>
                @endforeach

                    {{-- Pagination Bootstrap 5 --}}
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center"> {{-- 'justify-content-center' pour centrer la pagination --}}

                    {{-- Lien "Précédent" --}}
                    <li class="page-item {{ ($classes->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $classes->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    {{-- Liens des pages --}}
                    @for ($i = max(1, $classes->currentPage() - 2); $i <= min($classes->lastPage(), $classes->currentPage() + 2); $i++)
                        <li class="page-item {{ ($classes->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $classes->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Lien "Suivant" --}}
                    <li class="page-item {{ ($classes->currentPage() == $classes->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $classes->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>

                </ul>
            </nav>
            @else
                <p>No classes found.</p>
            @endif



@endsection


