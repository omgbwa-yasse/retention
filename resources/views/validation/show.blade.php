@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Détails de la règle</div>

                <div class="card-body">
                    <h5 class="card-title">{{ $rule->name }}</h5>
                    <p class="card-text">
                        <strong>ID:</strong> {{ $rule->id }}<br>
                        <strong>Description :</strong> {{ $rule->description }}<br>
{{--                        <strong>Pays:</strong> {{ $rule->countries->name }}<br>--}}
                        <strong>Statut:</strong>
                        @if ($rule->status_id == 1)
                            <span class="badge badge-primary">En attente</span>
                        @elseif ($rule->status_id == 2)
                            <span class="badge badge-success">Validé</span>
                        @elseif ($rule->status_id == 3)
                            <span class="badge badge-danger">Rejeté</span>
                        @endif
                        <br>
                        <strong>Validé par:</strong> {{ $rule->validated_By ? $rule->validatedBy->name : 'Non validé' }}<br>
                        <strong>Validé le:</strong> {{ $rule->validated_at ? $rule->validated_at->format('Y-m-d H:i:s') : 'Non validé' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
{{--            <a name=""  id="" class="btn btn-primary" href="{{ route('rule.show', $rule ) }}" role="button" >Afficher la règles</a>--}}
            <a name=""  id="" class="btn btn-primary" href="{{ route('rule.index')}}" role="button" >Retour vers les règles</a>
{{--            <a name=""  id="" class="btn btn-primary" href="{{ route('validation.index') }}" role="button" >Retour vers les status</a>--}}
        </div>
    </div>
</div>
@endsection
