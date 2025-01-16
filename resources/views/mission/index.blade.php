@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Missions</h1>
                <a href="{{ route('mission.create') }}" class="btn btn-primary">Add Mission</a>

                <ul class="list-group mt-5">
                    @foreach($activities as $mission)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column me-2">
                            <div> <strong> {{ $mission->code }} </strong> - {{ $mission->name }}</div>
                        </div>
                        <div>
                            <a href="{{ route('mission.show', $mission->id) }}" class="btn btn-primary">View</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
