@extends('index')

@section('content')
<h2>Liste des paniers</h2>
@if (empty($basketReference) && empty($basketActivities) && empty($basketRules) )

<div class="alert alert-primary" role="alert">
    <strong>Remarque</strong> : Vous n'avez aucun panier
    <a href="{{ route('basket.create') }}" class="btn btn-sm btn-primary">Ajouter</a>
</div>

@else

    <h4>Activités</h4>
    <table class="table table-grey" style="width:100%">
        @foreach ($basketActivities as $basket)
            <tr>
            <td>{{ $basket->name }}</td>
            <td>{{ $basket->description }}</td>
            <td>
                <div class="float-right">
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-success">Actions</a>
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-primary">Afficher</a>
                </div>
            </td>
            </tr>
        @endforeach
    </table>

    <h4>Conservation</h4>
    <table class="table table-danger" style="width:100%">

        @foreach ($basketRules as $basket)
            <tr>
            <td>{{ $basket->name }}</td>
            <td>{{ $basket->description }}</td>
            <td>
                <div class="float-right">
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-success">Actions</a>
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-primary">Afficher</a>
                </div>
            </td>
            </tr>
        @endforeach

    </table>

    <h4>References</h4>
    <table class="table table-success table-striped">

        @foreach ($basketReference as $basket)
            <tr>
            <td>{{ $basket->name }}</td>
            <td>{{ $basket->description }}</td>
            <td>
                <div class="float-right">
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-success">Actions</a>
                    <a href="{{ route('basket.show', $basket) }}" class="btn btn-sm btn-primary">Afficher</a>
                </div>
            </td>
            </tr>
        @endforeach

    </table>
  @endif
@endsection
