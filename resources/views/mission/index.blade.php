@extends('index')

@section('content')
    <div class="container">
        <h1>Toutes les missions du {{ $country->name }} ({{ $country->abbr}})</h1>
        <a href="{{ route('mission.create') }}" class="btn btn-primary mb-2">Ajouter un domaine</a>

        <!-- Ajouter ce formulaire pour la barre de recherche -->
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher...">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Horizontal under breakpoint -->

        <ul class="list-group list-group-vertical">

            @foreach ($items as $item)
                <li class="list-group-item list-unstyled pl-3">
                    @if ($item->children->isNotEmpty())
                        <a class="toggle-subclass collapsed" data-toggle="collapse" href="#{{ $item->code }}"
                           aria-expanded="false" aria-controls="{{ $item->code }}" id="toggle-icon{{ $item->code }}">
                            <i class="bi bi-plus-circle" id="plus-icon{{ $item->code }}"></i>
                            <i class="bi bi-dash-circle" id="dash-icon{{ $item->code }}" style="display: none;"></i>
                        </a>

                    @endif
                    {{ $item->code }} : {{ $item->name }}
                    <a href="{{ route('mission.show', $item) }}" class="btn btn-primary mb-2 float-end">Voir</a>
                </li>
                    <div class="collapse show" id="{{ $item->code }}">
                @include('mission.subclasses', ['subclasses' => $item->children])
                    </div>

            @endforeach
        </ul>



    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleIcon = document.querySelector('#toggle-icon{{ $item->code }}');
            var plusIcon = document.querySelector('#plus-icon{{ $item->code }}');
            var dashIcon = document.querySelector('#dash-icon{{ $item->code }}');

            toggleIcon.addEventListener('click', function() {
                plusIcon.style.display = (plusIcon.style.display === 'none') ? 'inline' : 'none';
                dashIcon.style.display = (dashIcon.style.display === 'none') ? 'inline' : 'none';
            });
        });
    </script>


@endsection
