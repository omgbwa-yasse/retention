<!-- resources/views/public/rules/show.blade.php -->
@extends('index')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $rule->name }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Code:</strong> {{ $rule->code }}</p>
            <p><strong>Description:</strong> {{ $rule->description }}</p>
            <p><strong>Country:</strong> {{ $rule->country->name }}</p>
            <p><strong>Status:</strong> {{ $rule->status->name }}</p>
            <p><strong>Validated At:</strong> {{ $rule->validated_at }}</p>
            <p><strong>Validated By:</strong> {{ $rule->validator->name }}</p>

            <h2 class="mt-4">Classifications</h2>
            <ul class="list-group">
                @foreach($rule->classifications as $classification)
                    <li class="list-group-item">{{ $classification->name }}</li>
                @endforeach
            </ul>

            <h2 class="mt-4">Duls</h2>
            <ul class="list-group">
                @foreach($rule->duls as $dul)
                    <li class="list-group-item">
                        <strong>Dul:</strong> {{ $dul->name }}
                        <ul class="list-group mt-2">
                            <li class="list-group-item"><strong>Trigger:</strong> {{ $dul->trigger->name }}</li>
                            <li class="list-group-item"><strong>Sort:</strong> {{ $dul->sort->name }}</li>
                            <li class="list-group-item">
                                <strong>Articles:</strong>
                                <ul class="list-group mt-2">
                                    @foreach($dul->articles as $article)
                                        <li class="list-group-item">{{ $article->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
