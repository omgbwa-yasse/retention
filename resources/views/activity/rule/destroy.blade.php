@extends('index')

@section('content')

<h1>Remove Rule {{ $rule->name }} from Classification {{ $activity->name }}</h1>

<p>Are you sure?</p>

<form action="{{ route('activity.rule.destroy', [$activity, $rule]) }}" method="POST">
    @csrf
    @method('DELETE')
    <div>
        <button type="submit">Yes</button>
    </div>
</form>

<a href="{{ route('activity.rule.index', $activity) }}">No</a>
@endsection
