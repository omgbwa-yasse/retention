@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $rule->name }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ $rule->code }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">--- Pays non vaide ---</h6>
                <p class="card-text">{{ $rule->description }}</p>

            </div>

            <h5>Cycle de vie</h5>
            <div class="table-responsive mb-12">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr class="">
                            <td colspan="3">Active</td>
                        </tr>
                        <tr class="">
                            <td>Durée</td>
                            <td>Déclencheur</td>
                            <td>Description</td>
                            <td>Sort</td>
                        </tr>
                        <tr class="">
                        @if($rule->duas->isEmpty())
                            <td> N/A </td>
                            <td> N/A </td>
                            <td> N/A </td>
                        @else
                            @foreach($rule->actives as $active)
                                <td>{{ $active->duration }} ans </td>
                                <td>{{ $active->trigger->code }} - {{ $active->trigger->name }} </td>
                                <td>{{ $active->description }} </td>
                                <td>{{ $active->sort->code }}</td>
                            @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>


                <div class="table-responsive mb-12">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr class="">
                                <td colspan="3">Semi-active</td>
                            </tr>
                            <tr class="">
                                <td>Durée</td>
                                <td>Déclencheur</td>
                                <td>Description</td>
                                <td>Sort</td>

                            </tr>
                            <tr class="">

                            @if($rule->duas->isEmpty())
                            <td> N/A </td>
                            <td> N/A </td>
                            <td> N/A </td>
                            @else
                                @foreach($rule->duas as $dua)
                                    <td>{{ $dua->duration }} ans </td>
                                    <td>{{ $dua->trigger->code }} - {{ $dua->trigger->name }} </td>
                                    <td>{{ $dua->description }} </td>
                                    <td>{{ $dua->sort->code }}</td>
                                @endforeach
                            @endif
                            </tr>
                        </tbody>
                    </table>
            </div>




                    <div class="table-responsive mb-12">
                        <table class="table table-bordered align-middle">
                            <tbody>
                                <tr class="">
                                    <td colspan="3">Définitive</td>
                                </tr>
                                <tr class="">
                                    <td>Durée</td>
                                    <td>Déclencheur</td>
                                    <td>Description</td>
                                    <td>Sort</td>
                                </tr>
                                <tr class="">
                                @if($rule->duls->isEmpty())
                                    <td> N/A </td>
                                    <td> N/A </td>
                                    <td> N/A </td>
                                @else
                                    @foreach($rule->duls as $dul)
                                        <td>{{ $dul->duration }} ans </td>
                                        <td>{{ $dul->trigger->code }} - {{ $dul->trigger->name }} </td>
                                        <td>{{ $dul->description }} </td>
                                        <td>{{ $dul->sort->code }}</td>
                                    @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                </div>

            Status : <a href="{{ route('validation.show', $rule->id) }}">
                <span class="badge badge-danger">{{ $rule->status->name }}</span></a><br>
            Articles : <a href="{{ route('validation.show', $rule->id) }}"> 10 articles </a>

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

                <hr>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary me-md-2 mb-2 mb-md-0">Modifier</a>

                <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
        </div>
    </div>
</div>

@endsection
