@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $rule->name }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ $rule->code }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">--- Pays non vaide ---</h6>
                <p class="card-text">{{ $rule->description }}</p>

                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary me-md-2 mb-2 mb-md-0">Modifier</a>

                <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>

            <h3> Durée active : Bureau </h3>
            <div>
                <ul>
                    @if($rule->duas->isEmpty())
                        <li> Aucun délai actif </li>
                    @else
                        @foreach($rule->actives as $active)
                            <li>{{ $active->duration }} ans - {{ $active->description }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>


            <h3> Durée semi-active : Préarchivage </h3>
            <div>
                <ul>
                    @if($rule->duas->isEmpty())
                        <li> Aucun délai semi-actif </li>
                    @else
                        @foreach($rule->duas as $dua)
                            <li>{{ $dua->duration }} ans - {{ $dua->description }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>



            <h3> Durée passive : Archives historiques </h3>
            <div>
                <ul>
                    @if($rule->duls->isEmpty())
                        <li> Aucune règle </li>
                    @else
                        @foreach($rule->duls as $dul)
                            <li>{{ $dul->duration }} ans - {{ $dul->description }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>


            <h3> Activités </h3>

                <div>
                    <ul>
                        @if($rule->classifications->isEmpty())
                            <li> Aucune règle </li>
                        @else
                            @foreach($rule->classifications as $classification)
                                <li>{{ $classification->code }}  - {{ $classification->name }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>


                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('active.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée active</a>
                    <a href="{{ route('rule.dua.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée semi-active</a>
                    <a href="{{ route('rule.dul.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée passive</a>
                    <a href="{{ route('rule.classification.create', $rule->id) }}" class="btn btn-primary btn-sm">Aux activités</a>
                </div>

        </div>
    </div>
</div>

@endsection
