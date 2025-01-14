@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card me-2">
                <h1>Ajouter un article</h1>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <strong>Référence:</strong>
                            <p>{{ $rule->code }}</p>
                        </div>
                        <div class="col-md-10">
                            <strong>Intitulé:</strong>
                            <p>{{ $rule->name }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $rule->description }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @foreach ($articles as $items => $article)
                    {{ $article->reference }} <br> <br> <br>
                @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
