@extends('index')

@section('content')

<h1>Remove Rule {{ $rule->name }} from Classification {{ $classification->name }}</h1>

<p>Are you sure?</p>

<form action="{{ route('activity.rule.destroy', [$classification, $rule]) }}" method="POST">
    @csrf
    @method('DELETE')
    <div>
        <button type="submit">Yes</button>
    </div>
</form>

<a href="{{ route('activity.rule.index', $classification) }}">No</a>
@endsection
