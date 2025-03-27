@extends('index')

@section('content')
    <h1>{{ __('edit_activity') }}</h1>

    <form action="{{ route('activity.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">{{ __('code') }}</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $activity->code }}" required>
        </div>

        <div class="form-group">
            <label for="name">{{ __('name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $activity->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">{{ __('description') }}</label>
            <textarea class="form-control" id="description" name="description">{{ $activity->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="parent_id">{{ __('parent') }}</label>
            <select class="form-control" id="parent_id" name="parent_id">
                @foreach ($activities as $parent)
                    <option value="{{ $parent->id }}" @selected($activity->parent_id == $parent->id)>{{$parent->code }} - {{$parent->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="country_id" value="{{ auth()->user()->country_id }}">

        <button type="submit" class="btn btn-primary">{{ __('save') }}</button>
        <a href="{{ route('activity.index') }}" class="btn btn-secondary">{{ __('cancel') }}</a>
    </form>
@endsection
