@extends('index')

@section('content')
            <div class="container text-center my-4">
                <h1>Trouvez vos délais de conservation !</h1>
                <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center">
                    <input type="text" name="query" class="form-control me-2" placeholder="Search..." />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>


            {{
                $records
            }}

            @if($records->count())
                @foreach($records as $class)


                        $class

                    {{--
                        <div class="list-group mb-3">
                        <div class="list-group-item">
                            <h2 class="fw-bold">{{$item->name }}</h2>
                            <p class="mb-1">{{ $item->description }}</p>
                            <p class="mb-0">
                            @if( $item->parent)
                                    Voir aussi : {{ $item->parent->name ?? "" }}
                                @endif
                            </p>
                            <small class="text-muted">{{ $item->country->name }} ({{ $item->country->abbr }}), créé le {{ $item->created_at }} par {{ $item->user->name }} </small>
                        </div>
                    </div>
                    --}}
                @endforeach





                {{-- Pagination Bootstrap 5 --}}
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center"> {{-- 'justify-content-center' pour centrer la pagination --}}

                        {{-- Lien "Précédent" --}}
                        <li class="page-item {{ ($records->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Liens des pages --}}
                        @for ($i = max(1, $records->currentPage() - 2); $i <= min($records->lastPage(), $records->currentPage() + 2); $i++)
                            <li class="page-item {{ ($records->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $records->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Lien "Suivant" --}}
                        <li class="page-item {{ ($records->currentPage() == $records->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>






            @else
                <p>No classes found.</p>
            @endif



@endsection


